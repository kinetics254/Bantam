<?php

namespace App\Jobs;

use App\ApprovalEntries;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\NavSoap\NavSyncManager;
use App\Notifications\FailedUpdatingApprovalsEntriesToNav;
use Illuminate\Support\Facades\Notification;

class SendApprovalEntriesToNav implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $approvalEntry;
    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct(ApprovalEntries $approvalEntry)
    {
        $this->approvalEntry = $approvalEntry;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $NavSyncManager = new NavSyncManager();
        $NavSyncManager->sendLeaveApprovals($this->approvalEntry);
    }

    public function failed(\Exception $exception)
    {
        Notification::send($this->approvalEntry->employee->user, new FailedUpdatingApprovalsEntriesToNav());
    }
}
