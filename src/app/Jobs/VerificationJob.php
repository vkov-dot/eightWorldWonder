<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $code;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, int $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info($this->code);
        Mail::send('emails.users.verify', ['user' => $this->user, 'code' => $this->code], function ($message) {
            $message->to($this->user->email, 'TO PALMO-TEST');
            $message->from('from.palmo@gmail.com', 'FROM PALMO');
        });
    }
}
