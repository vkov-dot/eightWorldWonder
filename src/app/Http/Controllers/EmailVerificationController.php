<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\VerifyRequest;
use App\Jobs\VerificationJob;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmailVerificationController extends RegisterController
{
    public function verify(Request $request)
    {
        $user = User::where('email', $request->email)->get();

        if(!$user->count()) {
            $code = rand(1000, 9999);
            $user = RegisterController::create($request, $code);
            VerificationJob::dispatch($user, $code);
        }
        $user = User::where('email', $request->email)->get();

        return view('auth.verify', ['userId' => $user[0]->id]);
    }

    public function activate(Request $request)
    {
        $user = User::find($request->id);
        if($user->verify_code === (int)$request->verify_code) {
            $user->email_verified_at = new DateTime();
            $user->email_verified = 1;
            $user->update();
            return redirect()->route('login');
        }

        return $this->reset($request);
    }

    public function reset(Request $request)
    {
        $code = rand(1000, 9999);
        $user = User::find($request->id);
        $user->verify_code = $code;
        $user->update();
        VerificationJob::dispatch($user, $code);

        return view('auth.verify', ['userId' => $user->id]);
    }
}
