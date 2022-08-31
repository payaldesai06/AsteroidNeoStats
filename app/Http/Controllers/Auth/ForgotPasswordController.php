<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $user_check = User::where('email', $request->email)->first();
        if($user_check){
            if (@$user_check->role_id == 2) {
                return back()->with('status', 'Your have no permission for this action.');
            } else {
                $response = $this->broker()->sendResetLink(
                    $request->only('email')
                );
                if ($response) {
                    return back()->with('status',trans($response));
                }
                return back()->withErrors(
                    ['email' => trans($response)]
                );
            }
        }else{
            return back()->with('status', 'Email not found!');
        }
    }
}
