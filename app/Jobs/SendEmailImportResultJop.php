<?php

namespace App\Jobs;

use App\Mail\ImportResult;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendEmailImportResultJop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $success;
    private $failure;


    /**
     * Create a new job instance.
     *
     * @param $success
     * @param $failure
     */
    public function __construct($failure, $success)
    {
        $this->success = $success;
        $this->failure = $failure;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        \Log::info("success-> $this->success ----- fails-> $this->failure");

        $email = new ImportResult($this->success, $this->failure);
        Mail::to('ibrahimramadan7069@gmail.com')->send($email);
    }
}
