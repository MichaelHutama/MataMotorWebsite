<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Mechanic;

class AuthController extends Controller
{
    // ── Customer Login
    public function showLogin()  { return view('login'); }

    public function login(Request $request)
    {
        $request->validate([
            'Email'    => 'required|email',
            'Password' => 'required',
        ]);

        $customer = Customer::where('Email', $request->Email)->first();

        if (!$customer || !Hash::check($request->Password, $customer->Password)) {
            return back()->withErrors(['Email' => 'Email atau password salah.'])->withInput();
        }

        session([
            'customer_id'   => $customer->CustomerID,
            'customer_name' => $customer->CustomerName,
            'role'          => 'customer',
        ]);

        return redirect()->route('customer-home');
    }

    // ── Customer Register
    public function showRegister() { return view('signup'); }

    public function register(Request $request)
    {
        $request->validate([
            'CustomerName'          => 'required|string|max:100',
            'Email'                 => 'required|email|unique:customers,Email',
            'Password'              => 'required|min:6|confirmed',
            'Number'                => 'required|string|max:20',
            'Address'               => 'required|string|max:255',
        ]);

        $customer = Customer::create([
            'CustomerName' => $request->CustomerName,
            'Email'        => $request->Email,
            'Password'     => Hash::make($request->Password),
            'Number'       => $request->Number,
            'Address'      => $request->Address,
        ]);

        session([
            'customer_id'   => $customer->CustomerID,
            'customer_name' => $customer->CustomerName,
            'role'          => 'customer',
        ]);

        return redirect()->route('customer-home');
    }

    // ── Staff Login (Owner & Mechanic — halaman sama)
    public function showStaffLogin() { return view('loginadminmechanic'); }

    public function staffLogin(Request $request)
    {
        $request->validate([
            'MechanicName' => 'required',
            'Password'     => 'required',
        ]);

        $mechanic = Mechanic::where('MechanicName', $request->MechanicName)->first();

        if (!$mechanic || !Hash::check($request->Password, $mechanic->Password)) {
            return back()->withErrors(['MechanicName' => 'Nama atau password salah.'])->withInput();
        }

        if (!$mechanic->IsActive) {
            return back()->withErrors(['MechanicName' => 'Akun tidak aktif.'])->withInput();
        }

        // MEC-0 = Owner
        if ($mechanic->MechanicID === 'MEC-0') {
            session([
                'mechanic_id'   => $mechanic->MechanicID,
                'mechanic_name' => $mechanic->MechanicName,
                'role'          => 'owner',
            ]);
            return redirect()->route('owner-home');
        }

        // Mechanic biasa
        session([
            'mechanic_id'   => $mechanic->MechanicID,
            'mechanic_name' => $mechanic->MechanicName,
            'role'          => 'mechanic',
        ]);
        return redirect()->route('mechanic-home');
    }

    // ── Logout (semua role)
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}