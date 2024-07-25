@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4" style="color: #002603;">Détails de l'utilisateur</h1>

    <div class="card" style="border: 1px solid #618062; background-color: #EDF2EE;">
        <div class="card-body">
            <h5 class="card-title" style="color: #002603;">{{ $user->name }}</h5>
            <p class="card-text" style="color: #002603;"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text" style="color: #002603;"><strong>Rôle:</strong> {{ ucfirst($user->role) }}</p>
            <p class="card-text" style="color: #002603;"><strong>Créé le:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text" style="color: #002603;"><strong>Mis à jour le:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.users.edit', $user) }}" class="btn" style="background-color: #618062; color: #EDF2EE; border: none; margin-top: 1rem;">Modifier</a>
    <a href="{{ route('admin.users.index') }}" class="btn" style="background-color: #002603; color: #EDF2EE; border: none; margin-top: 1rem;">Retour à la liste</a>
</div>
@endsection
