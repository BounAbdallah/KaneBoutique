@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Gestion des Commandes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Client</th>
                <th>Email du Client</th>
                <th>Nombre d'Articles</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>{{ $order->items_count }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm">Voir</a>
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Confirmer la validation de la commande ?')">Valider</button>
                    </form>
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="canceled">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer l\'annulation de la commande ?')">Annuler</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
