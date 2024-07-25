@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <div class="row">
        <div class="col-md-6">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="col-md-6">
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Prix:</strong> {{ $product->price }} FCFA</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <div class="form-group">
                    <label for="quantity">Quantité</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter au Panier</button>
            </form>
        </div>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Retour à la Liste</a>
</div>
@endsection
