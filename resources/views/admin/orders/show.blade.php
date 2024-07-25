@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Détails de la Commande</h1>

    <div class="card">
        <div class="card-header">
            Commande #{{ $order->id }}
        </div>
        <div class="card-body">
            <p><strong>Nom du Client:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email du Client:</strong> {{ $order->customer_email }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

            <h4>Articles</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity * $item->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection
