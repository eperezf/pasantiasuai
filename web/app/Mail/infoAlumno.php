<?php

namespace App\Mail;

use App\Pasantia;
use App\User;
use App\Empresa;
use App\EvalTutor;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class infoAlumno extends Mailable
{
  use Queueable, SerializesModels;

  public $pasantia;
	public $user;
	public $empresa;
	public $evalTutor;
	public $mailSubject;
	public $mailView;

  public function __construct(Pasantia $pasantia = null, User $user = null, Empresa $empresa = null, EvalTutor $evalTutor = null, $mailSubject, $mailView) {
    $this->user = $user;
		$this->pasantia = $pasantia;
		$this->empresa = $empresa;
		$this->evalTutor = $evalTutor;
		$this->mailSubject = $mailSubject;
		$this->mailView = $mailView;
  }
  public function build()
  {
    return $this->subject($this->mailSubject)->view($this->mailView);
  }
}
