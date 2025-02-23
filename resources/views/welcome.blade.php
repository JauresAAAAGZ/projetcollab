@extends('layout.apps')

@section('content')
<div class="container">
    <!-- Personalized Welcome Section -->
    <div class="welcome-box text-center py-4">
        <h1>👋 Hello, {{ auth()->user()->name }}!</h1>
        <h4 id="greeting"></h4>
        <p class="text-muted">Today is <strong id="current-date"></strong>, and the time is <strong id="current-time"></strong></p>
    </div>

    <!-- Stats Section -->
    <div class="row text-center mb-4">
        <div class="col-md-6">
            <div class="stats-card">
                <h3>{{ $ownedProjects->count() }}</h3>
                <p>Projects Created</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stats-card">
                <h3>{{ $collaboratingProjects->count() }}</h3>
                <p>Collaborations</p>
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <div class="row">
        <!-- Projects Created by the User -->
        <div class="col-md-6">
            <h2 class="mb-3 text-primary">📌 My Created Projects</h2>
            <div class="row">
                @foreach ($ownedProjects as $project)
                    <div class="col-md-12 mb-3">
                        <div class="card project-card">
                            <div class="card-body">
                                <h5 class="card-titre">{{ $project->titre }}</h5>
                                <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                                <p class="text-muted">📅 {{ $project->date_debut }} → {{ $project->date_fin }}</p>
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-primary">View Project</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Collaborations -->
        <div class="col-md-6">
            <h2 class="mb-3 text-success">🤝 Collaborations</h2>
            <div class="row">
                @foreach ($collaboratingProjects as $project)
                    <div class="col-md-12 mb-3">
                        <div class="card project-card">
                            <div class="card-body">
                                <h5 class="card-titre">{{ $project->titre }}</h5>
                                <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                                <p class="text-muted">🛠 Role: <strong>{{ $project->collaborators->where('id', auth()->id())->first()->pivot->role }}</strong></p>
                                <p class="text-muted">📅 {{ $project->date_debut }} → {{ $project->date_fin }}</p>
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-success">View Project</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Welcome Box */
    .welcome-box {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
    }

    /* Stats Cards */
    .stats-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .stats-card h3 {
        font-size: 2rem;
        font-weight: bold;
        color: #6a11cb;
    }

    .stats-card:hover {
        transform: scale(1.05);
    }

    /* Project Cards */
    .project-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.1);
        perspective: 1000px;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    }

    .project-card:hover {
        transform: scale(1.05) rotateX(5deg) rotateY(5deg);
        box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- JavaScript for Dynamic Time & Greeting -->
<script>
    function updateDateTime() {
        const date = new Date();
        document.getElementById('current-date').innerText = date.toLocaleDateString();
        document.getElementById('current-time').innerText = date.toLocaleTimeString();

        const hours = date.getHours();
        let greeting = "🌅 Good Morning!";
        if (hours >= 12 && hours < 18) {
            greeting = "☀️ Good Afternoon!";
        } else if (hours >= 18) {
            greeting = "🌙 Good Evening!";
        }
        document.getElementById('greeting').innerText = greeting;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>
@endsection
