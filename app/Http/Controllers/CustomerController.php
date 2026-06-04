<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Queue;
use App\Models\Cart;
use App\Models\SparePart;
use App\Models\SparePartCategory;
use App\Models\ServiceCategory;
use App\Models\Transaction;
use App\Models\SparePartSales;
use App\Models\SparePartSalesItem;
use App\Models\Payment;

class CustomerController extends Controller
{
    private function me(): Customer
    {
        return Customer::findOrFail(session('customer_id'));
    }

    // HOME
    public function home()
    {
        $customer   = $this->me();
        $categories = ServiceCategory::all();
        $spareParts = SparePart::with('category')->latest()->take(8)->get();
        return view('customer-home', compact('customer', 'categories', 'spareParts'));
    }

    // PRODUCTS
    public function products()
    {
        $spareParts = SparePart::with('category')->get();
        $categories = SparePartCategory::all();
        return view('products', compact('spareParts', 'categories'));
    }

    public function productDetail($id)
    {
        $part = SparePart::with('category')->findOrFail($id);
        return view('productdetail', compact('part'));
    }

    // VEHICLE
    public function storeVehicle(Request $request)
    {
        $request->validate([
            'VehicleCategory' => 'required',
            'Brand'           => 'required',
            'ProductionYear'  => 'required|digits:4',
            'PlateNumber'     => 'required',
        ]);

        Vehicle::create([
            'CustomerID'      => session('customer_id'),
            'VehicleCategory' => $request->VehicleCategory,
            'Brand'           => $request->Brand,
            'ProductionYear'  => $request->ProductionYear,
            'PlateNumber'     => $request->PlateNumber,
        ]);

        return back()->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Vehicle::where('VehicleID', $id)
                          ->where('CustomerID', session('customer_id'))->firstOrFail();
        $vehicle->update($request->only('VehicleCategory','Brand','ProductionYear','PlateNumber'));
        return back()->with('success', 'Kendaraan diperbarui.');
    }

    public function deleteVehicle($id)
    {
        Vehicle::where('VehicleID', $id)
               ->where('CustomerID', session('customer_id'))->firstOrFail()->delete();
        return back()->with('success', 'Kendaraan dihapus.');
    }

    // BOOKING
    public function booking()
    {
        $customer   = $this->me();
        $vehicles   = $customer->vehicles;
        $bookings   = Queue::where('CustomerID', $customer->CustomerID)
                          ->with('vehicle', 'serviceCategory', 'servicePerformed')
                          ->orderByDesc('BookingTime')->get();
        $categories = ServiceCategory::all();
        return view('customer-booking', compact('customer', 'vehicles', 'bookings', 'categories'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'VehicleID'         => 'required',
            'BookingTime'       => 'required|date|after_or_equal:today',
            'ServiceCategoryID' => 'required',
        ]);

        Queue::create([
            'CustomerID'        => session('customer_id'),
            'VehicleID'         => $request->VehicleID,
            'BookingTime'       => $request->BookingTime,
            'ServiceCategoryID' => $request->ServiceCategoryID,
            'Description'       => $request->Description,
            'QueueStatus'       => 'Pending',
        ]);

        return back()->with('success', 'Booking berhasil dibuat!');
    }

    public function cancelBooking($id)
    {
        $queue = Queue::where('QueueID', $id)
                      ->where('CustomerID', session('customer_id'))->firstOrFail();
        $queue->update(['QueueStatus' => 'Cancelled']);
        return back()->with('success', 'Booking dibatalkan.');
    }

    // CART
    public function cart()
    {
        $customer  = $this->me();
        $cartItems = Cart::where('CustomerID', $customer->CustomerID)
                        ->with('sparePart.category')->get();
        return view('customer-cart', compact('customer', 'cartItems'));
    }

    public function addToCart(Request $request)
    {
        $request->validate(['SparePartID' => 'required', 'Quantity' => 'required|integer|min:1']);

        $existing = Cart::where('CustomerID', session('customer_id'))
                        ->where('SparePartID', $request->SparePartID)->first();

        if ($existing) {
            $existing->increment('Quantity', $request->Quantity);
        } else {
            Cart::create([
                'CustomerID'  => session('customer_id'),
                'SparePartID' => $request->SparePartID,
                'Quantity'    => $request->Quantity,
                'IsChecked'   => false,
            ]);
        }
        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = Cart::where('CartID', $id)->where('CustomerID', session('customer_id'))->firstOrFail();
        if ($request->has('Quantity'))  $cart->update(['Quantity'  => $request->Quantity]);
        if ($request->has('IsChecked')) $cart->update(['IsChecked' => $request->boolean('IsChecked')]);
        return back();
    }

    public function removeFromCart($id)
    {
        Cart::where('CartID', $id)->where('CustomerID', session('customer_id'))->delete();
        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    // CHECKOUT
    public function checkout()
    {
        $customer  = $this->me();
        $cartItems = Cart::where('CustomerID', $customer->CustomerID)
                        ->where('IsChecked', true)->with('sparePart')->get();
        return view('customer-checkout', compact('customer', 'cartItems'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'DeliveryMethod'  => 'required',
            'ReceiverName'    => 'required',
            'ReceiverPhone'   => 'required',
            'ReceiverAddress' => 'required',
        ]);

        $customerId = session('customer_id');
        $cartItems  = Cart::where('CustomerID', $customerId)
                         ->where('IsChecked', true)->with('sparePart')->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors(['cart' => 'Tidak ada item yang dipilih.']);
        }

        $total = $cartItems->sum(fn($item) => $item->sparePart->Price * $item->Quantity);

        $transaction = Transaction::create(['CustomerID' => $customerId]);

        $sales = SparePartSales::create([
            'TransactionID'   => $transaction->TransactionID,
            'Type'            => 'Online',
            'Status'          => 'Pending',
            'PriceAtPurchase' => $total,
            'DeliveryMethod'  => $request->DeliveryMethod,
            'ReceiverName'    => $request->ReceiverName,
            'ReceiverPhone'   => $request->ReceiverPhone,
            'ReceiverAddress' => $request->ReceiverAddress,
            'Notes'           => $request->Notes,
        ]);

        foreach ($cartItems as $item) {
            SparePartSalesItem::create([
                'SparePartSalesID' => $sales->SparePartSalesID,
                'SparePartID'      => $item->SparePartID,
                'Amount'           => $item->Quantity,
            ]);
            $item->sparePart->decrement('Stock', $item->Quantity);
            $item->delete();
        }

        return redirect()->route('customer-payment', $transaction->TransactionID);
    }

    // PAYMENT
    public function payment($transactionId)
    {
        $customer    = $this->me();
        $transaction = Transaction::where('TransactionID', $transactionId)
                                  ->where('CustomerID', $customer->CustomerID)
                                  ->with('sparepartSales.items.sparePart','servicesPerformed.serviceCategory')
                                  ->firstOrFail();
        return view('customer-payment', compact('customer', 'transaction'));
    }

    public function submitPayment(Request $request, $transactionId)
    {
        $request->validate(['PaymentMethod' => 'required']);

        $transaction = Transaction::where('TransactionID', $transactionId)
                                  ->where('CustomerID', session('customer_id'))->firstOrFail();

        $total = $transaction->sparepartSales->sum('PriceAtPurchase')
               + $transaction->servicesPerformed->sum('PriceAtService');

        $docPath = null;
        if ($request->hasFile('PaymentDocument')) {
            $docPath = $request->file('PaymentDocument')->store('payments', 'public');
        }

        Payment::create([
            'TransactionID'  => $transactionId,
            'PaymentDocument'=> $docPath,
            'PaymentTime'    => now(),
            'PaymentStatus'  => 'Pending',
            'PaymentAmount'  => $total,
            'PaymentMethod'  => $request->PaymentMethod,
        ]);

        return redirect()->route('customer-paymentsuccess');
    }

    public function paymentSuccess() { return view('customer-paymentsuccess'); }

    // HISTORY
    public function history()
    {
        $customer     = $this->me();
        $transactions = Transaction::where('CustomerID', $customer->CustomerID)
                                   ->with('sparepartSales.items.sparePart','servicesPerformed.serviceCategory','payment')
                                   ->orderByDesc('TransactionTime')->get();
        $bookings = Queue::where('CustomerID', $customer->CustomerID)
                        ->with('vehicle','serviceCategory','servicePerformed')
                        ->orderByDesc('BookingTime')->get();
        return view('customer-history', compact('customer', 'transactions', 'bookings'));
    }

    public function submitReview(Request $request, $serviceId)
    {
        $request->validate(['Rating' => 'required|integer|min:1|max:5']);
        \App\Models\ServicePerformed::findOrFail($serviceId)->update([
            'Rating'     => $request->Rating,
            'ReviewDesc' => $request->ReviewDesc,
        ]);
        return back()->with('success', 'Review berhasil dikirim!');
    }

    // PROFILE
    public function profile()
    {
        $customer = $this->me();
        $vehicles = $customer->vehicles;
        return view('customer-profile', compact('customer', 'vehicles'));
    }

    public function updateProfile(Request $request)
    {
        $customer = $this->me();
        $request->validate([
            'CustomerName' => 'required|string|max:100',
            'Email'        => 'required|email|unique:customers,Email,' . $customer->CustomerID . ',CustomerID',
            'Number'       => 'required|string|max:20',
            'Address'      => 'required|string|max:255',
        ]);

        $data = $request->only('CustomerName','Email','Number','Address');
        if ($request->filled('Password')) {
            $data['Password'] = Hash::make($request->Password);
        }
        $customer->update($data);
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}