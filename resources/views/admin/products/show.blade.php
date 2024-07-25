@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Détails du Produit</h1>

    <div class="card">
        <div class="card-header">
            {{ $product->name }}
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Prix:</strong> {{ $product->price }} FCFA</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <p><strong>Catégorie:</strong> {{ $product->category->name }}</p>
            @if ($product->image)
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 200px;">
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection
