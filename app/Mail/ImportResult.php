<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImportResult extends Mailable
{
    use Queueable, SerializesModels;


    public $success;
    public $fail;

    /**
     * Create a new message instance.
     *
     * @param $success
     * @param $fail
     */
    public function __construct($success, $fail)
    {
        $this->success = $success;
        $this->fail = $fail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ibrahimramadan7069@gmail.com')
            ->view('emails.importResult');
    }
}
