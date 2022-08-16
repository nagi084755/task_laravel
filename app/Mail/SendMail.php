<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($email, $token)
  {
    $this->email = $email;
    $this->token = $token;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->to($this->email)
      ->subject('仮会員登録のご案内')
      ->text('provRegister.provRegisterMail')
      ->with([
        'email' => $this->email,
        'server' => request()->server->get('SERVER_NAME'),
        'token' => $this->token,
      ]);
  }
}
