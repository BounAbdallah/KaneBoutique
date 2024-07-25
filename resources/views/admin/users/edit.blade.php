@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Modifier l'utilisateur</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="role">Rôle</label>
            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Utilisateur</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

<style>
    .custom-container {
        background-color: #EDF2EE;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-heading {
        color: #002603;
        margin-bottom: 1.5rem;
    }

    .custom-label {
        color: #002603;
    }

    .custom-input,
    .custom-select {
        border-color: #618062;
        border-radius: 0.25rem;
    }

    .custom-input:focus,
    .custom-select:focus {
        border-color: #4e6e52;
        box-shadow: 0 0 0 0.2rem rgba(97, 128, 68, 0.25);
    }

    .btn-custom {
        background-color: #618062;
        color: #EDF2EE;
        border: none;
    }

    .btn-custom:hover {
        background-color: #4e6e52;
    }

    .invalid-feedback {
        color: #e03e3e;
    }
</style>
@endsection