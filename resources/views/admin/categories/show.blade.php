@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Détails de la Catégorie</h1>

    <div class="card">
        <div class="card-header">
            {{ $category->name }}
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $category->description }}</p>
            @if ($category->image)
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid" style="max-width: 200px;">
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection
