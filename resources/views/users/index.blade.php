@extends('layout.apps')

@section('content')
<div class="container">
    <h1>Liste des Utilisateurs</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter un Utilisateur</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
