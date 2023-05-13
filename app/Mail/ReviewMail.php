<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewMail extends Mailable
{
    use Queueable, SerializesModels;

    public $book_title,$review;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($book_title,$review)
    {
        $this->book_title = $book_title;
        $this->review = $review;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.ReviewMail')->subject("Your review submitted successfully")->with($this->book_title,$this->review);
    }
}
