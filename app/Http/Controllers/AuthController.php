<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Mechanic;

class AuthController extends Controller
{
    // Login khusus Customer
    public function loginCustomer(Request $request)
    {
        $credentials = $request->validate([
            'Email' => 'required|email',
            'Password' => 'required',
        ]);

        $customer = Customer::where('Email', $request->Email)->first();

        if ($customer && Hash::check($request->Password, $customer->Password)) {
            Auth::guard('web')->login($customer);
            return redirect()->route('customer.home')->with('success', 'Selamat datang!');
        }

        return back()->with('error', 'Email atau Password salah.');
    }

    // Login khusus Admin/Mechanic/Owner
    public function loginAdminMechanic(Request $request)
    {
        $request->validate([
            'MechanicID' => 'required|string',
            'Password' => 'required',
        ]);

        $mechanicID = strtoupper($request->MechanicID);
        $mechanic = Mechanic::where('MechanicID', $mechanicID)->first();

        if ($mechanic && Hash::check($request->Password, $mechanic->Password)) {
            if (!$mechanic->IsActive) {
                return back()->with('error', 'Akun Anda dinonaktifkan.');
            }

            Auth::guard('mechanic')->login($mechanic);

            if ($mechanic->MechanicID === 'MEC-0') {
                return redirect()->route('owner.home')->with('success', 'Selamat datang Owner!');
            }
            return redirect()->route('mechanic.home')->with('success', 'Selamat datang Mekanik!');
        }

        return back()->with('error', 'ID atau Password salah.');
    }

    // Registrasi Customer (signup.blade.php)
    public function signup(Request $request)
    {
        $request->validate([
            'CustomerName' => 'required|string|max:100',
            'Email' => 'required|email|unique:Customer,Email',
            'Password' => 'required|min:6',
            'Number' => 'required',
            'Address' => 'required'
        ]);

        Customer::create([
            'CustomerName' => $request->CustomerName,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'Number' => $request->Number,
            'Address' => $request->Address,
        ]);

        return redirect()->route('customer.login.page')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        Auth::guard('mechanic')->logout();
        return redirect()->route('customer.login.page')->with('success', 'Berhasil logout.');
    }
}