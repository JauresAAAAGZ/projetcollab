<?php

namespace App\Mail;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CollaboratorAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $user;

    public function __construct(Project $project, $user)
    {
        $this->project = $project;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Nouveau projet collaboratif')
                    ->markdown('emails.collaborator-added')
                    ->with([
                        'projectTitle' => $this->project->titre,
                        'userName' => $this->user->name,
                    ]);
    }
}
