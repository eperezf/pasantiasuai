<?php

namespace App\Jobs;

use App\Pasantia;
use App\User;
use App\Empresa;
use App\EvalTutor;
use App\Mail\infoAlumno;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class QueueEmailJob implements ShouldQueue {
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
  * Create a new job instance.
  *
  * @return void
  */
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

	/**
  * Execute the job.
  *
  * @return void
  */
  public function handle() {
		Mail::to($this->user->email)->send(new InfoAlumno($this->pasantia, $this->user, $this->empresa, $this->evalTutor, $this->mailSubject, $this->mailView));
  }
}
