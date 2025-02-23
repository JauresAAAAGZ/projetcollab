@component('mail::message')
# Bonjour {{ $userName }},

Vous avez été ajouté en tant que collaborateur sur le projet **{{ $projectTitle }}**.

Consultez le projet et commencez à collaborer dès maintenant !

@component('mail::button', ['url' => route('projects.show', $projectTitle)])
Voir le Projet
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
