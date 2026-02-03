<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tab;
use Illuminate\Support\Facades\Request as FRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class AuthAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function  index()
    {
        // Check if the IP address has exceeded the maximum login attempts
        $ip = FRequest::ip();
        $maxAttempts = 5; // Adjust this as per your requirements
        $show_captcha = false;
        $attempts = 0;
        if (Cache::has('login_attempts_' . $ip)) {
            $attempts = Cache::get('login_attempts_' . $ip);
            if ($attempts >= $maxAttempts) {
                $show_captcha = true;
            }
        }


        return view('admin.auth.login',compact('show_captcha','attempts'));
    }

    public function login(Request $request)
    {
        // Introduce a one-second delay before responding to the password check
        sleep(2);

        $validationRules = [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];


        // Check if the IP address has exceeded the maximum login attempts
        $ip = FRequest::ip();
        $maxAttempts = 5; // Adjust this as per your requirements
        $decayMinutes = 10; // Adjust this as per your requirements
        $attempts = 0;

        if (Cache::has('login_attempts_' . $ip)) {
            $attempts = Cache::get('login_attempts_' . $ip);

            if ($attempts >= $maxAttempts) {
                // IP address has reached the maximum login attempts, block the user
                $validationMessages = [];
                if (env('APP_ENV') == 'production') {
                    $validationRules['g-recaptcha-response'] = ['required',  new ReCaptcha()];
                    $validationMessages = [ 'g-recaptcha-response.required' => 'The recaptcha field is required.'];
                }

                $validatedData = $request->validate($validationRules, $validationMessages);

               // return back()->withErrors(['email' => 'Too many login attempts. Please try again later.']);
            }
        }



        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Perform the password check
        if (Auth::guard('admin')->attempt($credentials)) {
            $tabs = Tab::with(['visibletabs'])->get();
            $permissions = [];
            $role_id = Auth::guard('admin')->user()->role_id;
            foreach ($tabs as $tab) {
                if (isset($tab->url)) {
                    if (isset($role_id)) {
                        $visible = $tab->visibletabs()->where('role_id', $role_id)->first();
                        if (isset($visible)) {
                            $permissions[$tab->url] = [
                                'visible' => $visible->visible,
                                'add' => $visible->add_row,
                                'update' => $visible->update_row,
                                'delete' => $visible->delete_row,
                            ];
                        }
                    } else {
                        $permissions[$tab->url] = [
                            'visible' => 1,
                            'add' => 1,
                            'update' => 1,
                            'delete' => 1,
                        ];
                    }
                }
            }
            Cache::forget('login_attempts_' . $ip);
            Session::put('permission', $permissions);
            // return redirect(route('admin.admindashboard'));
            return redirect(route('admin.admindashboard'));

        } else {
            // Invalid credentials
            $attempts++;
            Cache::put('login_attempts_' . $ip, $attempts, now()->addMinutes($decayMinutes));

            return back()->withErrors(['email' => 'Invalid credentials']);
        }



        return back();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Session::forget('permission');
        $request->session()->invalidate();

        return redirect(route('admin.login'));
    }
}
