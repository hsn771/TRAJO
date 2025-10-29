<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    public function showLoginForm(){
        return view('customer.auth.customer_login');
    }

    public function login(Request $request){
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('customer_panel.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials, please try again.',
        ])->onlyInput('email');
    }

    public function showRegistrationForm(){
        $districts=District::get();
        $divisions=Division::get();
        return view('customer.auth.customer_register',compact('districts','divisions'));
    }

    public function logout(){
        request()->session()->flush();
        return redirect('/')->with('danger','Succfully Logged Out');
    }

   public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:customers,email',
        'password' => 'required|string|min:4|confirmed',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255'
    ]);

    // Create new customer
    $customer = Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'phone' => $request->phone,
        'address' => $request->address,
        'district_id' => $request->district
    ]);

    // Log in the new customer
    Auth::guard('customer')->login($customer);

    return redirect()->route('customer_panel.dashboard');
}

}
