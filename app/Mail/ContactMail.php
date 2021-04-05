<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->contact->email)->subject($this->contact->subject)->view('pages.mail.mail')->with('data',$this->contact->message);
      /*  return $this->from($this->sender)->subject('Message from Chess2Chess site')->view('partials.sendemail')->with('data', $this->data);*/

    }
}
