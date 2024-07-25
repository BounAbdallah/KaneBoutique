@extends('layouts.app')

@section('content')

    <!-- Alertes de succès et d'erreur -->
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

    <h1 class="page-title">Mes Commandes</h1>

    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du client</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td class="status-{{ strtolower($order->status) }}">{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-view">Voir Détails</a>
                        @if ($order->status !== 'pending')
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">Supprimer</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <style>
        .alert-success {
            background-color: #4d6d52;
            color: #fff;
            border: 1px solid #4d6d52;
        }

        .alert-danger {
            background-color: #d9534f;
            color: #fff;
            border: 1px solid #d9534f;
        }

        .page-title {
            color: #002603;
            margin-bottom: 20px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .orders-table th, .orders-table td {
            padding: 12px;
            border: 1px solid #e2e2e2;
        }

        .orders-table th {
            background-color: #618062;
            color: #fff;
        }

        .orders-table td {
            background-color: #f9f9f9;
        }

        .orders-table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .status-pending {
            color: #ffbf00; /* Jaune pour les commandes en attente */
        }

        .status-completed {
            color: #28a745; /* Vert pour les commandes complètes */
        }

        .status-cancelled {
            color: #dc3545; /* Rouge pour les commandes annulées */
        }

        .btn {
            padding: 8px 12px;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view {
            background-color: #002603;
            border: none;
        }

        .btn-delete {
            background-color: #d9534f;
            border: none;
        }

        .btn-view:hover, .btn-delete:hover {
            opacity: 0.8;
        }
    </style>
@endsection


  

