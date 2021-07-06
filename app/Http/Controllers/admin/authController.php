<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Auth;
class authController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validation = [
            // 'title' => 'required|unique:posts|max:255',
            'email' => 'required',
            'pasword' => 'required',
        ];
        // $this->validate($request,$validation);
        

        $user = User::where(['email'=> $request->email,'user_type'=>"admin"])->first();
        
        if ($user &&
            Hash::check($request->password, $user->password)) {
            $remember = $request->has('remember') ? true :false;
            $credentials = $user->only('email', 'password');
            // dd('crot');
            try {
                Auth::login($user,$remember);
            } catch (Exception $e) {
                dd($e);
            }
            
            return redirect()->route('admin.dashboard');
            
        }
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
