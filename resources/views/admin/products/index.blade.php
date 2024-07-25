@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Gestion des Produits</h1>
    <a href="{{ route('admin.products.create') }}" class="btn_ btn-primary mb-3">Ajouter un produit</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }} FCFA</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px; height: auto;">
                    @else
                        Pas d'image
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info btn-sm">Détails</a>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <style>
        .btn{
            width: 120px;
            margin-top: 4px;
        }
        .btn_{
            width: 160px;
            height: 400px;
            padding: 10px;
            margin-bottom: 200px;

            border-radius: 4px;
            background:#002603 ;
        }
    </style>
</div>
@endsection
