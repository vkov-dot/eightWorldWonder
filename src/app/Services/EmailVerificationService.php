<?php

namespace App\Services;

use App\Http\Controllers\Auth\RegisterController;
use App\Jobs\VerificationJob;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class EmailVerificationService extends BaseService
{

    public function verify(Request $request)
    {
        $user = User::where('email', $request->email)->get();

        if(!$user->count()) {
            $code = rand(1000, 9999);
            $user = (new RegisterController)->create($request, $code);
            VerificationJob::dispatch($user, $code);
        }
    }

    public function activate(Request $request)
    {
        $user = $this->find($request->id);
        if($user->verify_code === (int)$request->verify_code) {
            $user->email_verified_at = new DateTime();
            $user->email_verified = 1;
            $user->update();

            return redirect()->route('login');
        }

        return back();
    }

    public function reset(Request $request)
    {
        $code = rand(1000, 9999);
        $user = User::find($request->id);
        $user->verify_code = $code;
        $user->update();
        VerificationJob::dispatch($user, $code);
    }
}
