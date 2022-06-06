<?php

namespace App\Mail;

use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use App\Repositories\IssueRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IssuePublished extends Mailable
{
    use Queueable, SerializesModels;

    protected $issue;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(IssueRequest $issue)
    {
        $this->issue = $issue;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.issues.published')
            ->with([
                'issue' => $this->issue,
            ]);
    }
}
