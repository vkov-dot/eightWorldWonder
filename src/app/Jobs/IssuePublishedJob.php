<?php

namespace App\Jobs;

use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use App\Repositories\IssueRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class IssuePublishedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $issue;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($issue)
    {
        $this->issue = $issue;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.issues.published', ['issue' => $this->issue], function ($message) {
            $message->to('totest@gmail.com', 'TO PALMO-TEST');
            $message->from('from.palmo@gmail.com', 'FROM PALMO');
        });
    }
}
