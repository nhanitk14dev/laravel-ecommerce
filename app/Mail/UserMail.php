<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable {
  use Queueable, SerializesModels;

  /**
   * The company instance.
   *
   * @var Company
   */

  /**
   * Create a new message instance.
   *
   * @return void
   */

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build() {
    // return $this->from('example@example.com')
    //             ->subject('Registered for a Modus System')
    //             ->view('emails.user.welcome_email');
  }
}
