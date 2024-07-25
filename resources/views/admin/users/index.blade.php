@extends('layouts.admin')

@section('content')
<div class="container custom-container">
    <h1 class="custom-heading">Gestion des Utilisateurs</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-custom mb-3">Ajouter un utilisateur</a>

    @if(session('success'))
        <div class="alert custom-alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm custom-btn">Voir</a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm custom-btn">Modifier</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm custom-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>
    .custom-container {
        background-color: #EDF2EE;
        padding: 2rem;
        border-radius: 0.5rem;
    }

    .custom-heading {
        color: #002603;
        margin-bottom: 1.5rem;
    }

    .btn-custom {
        background-color: #618062;
        color: #EDF2EE;
        border: none;
    }

    .btn-custom:hover {
        background-color: #4e6e52;
    }

    .custom-alert {
        background-color: #002603;
        color: #EDF2EE;
        border: none;
    }

    .custom-table thead {
        background-color: #002603;
        color: #EDF2EE;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f8f8f8;
    }

    .custom-table tbody tr:hover {
        background-color: #e2e2e2;
    }

    .custom-btn {
        background-color: #618062;
        color: #EDF2EE;
        border: none;
    }

    .custom-btn:hover {
        background-color: #4e6e52;
    }
</style>
@endsection
