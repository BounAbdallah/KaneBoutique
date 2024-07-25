@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Mon Panier</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('cart') && count(session('cart')) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom du Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('cart') as $productId => $details)
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>{{ number_format($details['price'], 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($details['quantity'] * $details['price'], 0, ',', ' ') }} FCFA</td>
                    <td>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $productId }}">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td><strong>Total :</strong> {{ array_sum(array_column(session('cart'), 'quantity')) }} articles</td>
                    <td><strong>Montant total :</strong> {{ number_format(array_sum(array_map(function($item) { return $item['quantity'] * $item['price']; }, session('cart'))), 0, ',', ' ') }} FCFA</td>
                </tr>
            </tfoot>
        </table>
        <div class="text-right mt-3">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">Passer la Commande</button>
            </form>
        </div>
    @else
        <div class="alert alert-info">
            Votre panier est vide. <a href="{{ route('products.index') }}">Continuer vos achats</a>
        </div>
    @endif

    <!-- Ajout du bouton pour voir les commandes en dehors du bloc conditionnel -->
    <div class="text-right mt-3">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-lg">Mes Commandes</a>
    </div>
</div>
@endsection
