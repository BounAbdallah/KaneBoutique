<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Commande</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-HfX4vHAmxTg8u6YtGz3gi1RPdH9jD5tFR4hw8ib4M31gMDTy6F0+S7E63L7iWz0" crossorigin="anonymous">
    <style>
        body {
            background-color: #EDF2EE;
            color: #002603;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
            padding: 2rem;
        }
        .card {
            display: flex;
            flex-direction: row;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            background-color: #fff;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: #618062;
            color: #fff;
            border-radius: 1rem 1rem 0 0;
            padding: 1rem;
        }
        .card-body {
            padding: 2rem;
        }
        .btn-back {
            background-color: #002603;
            color: #fff;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-back:hover {
            background-color: #001a00;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-back:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
        }
        h1 {
            color: #618062;
            margin-bottom: 2rem;
            font-size: 2.5rem;
        }
        .info-box {
            background-color: #fff;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }
        .info-box p {
            margin-bottom: 0.75rem;
        }
        .info-box strong {
            color: #002603;
        }
        .table thead th {
            background-color: #618062;
            color: #fff;
            text-align: center;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .table tbody tr:hover {
            background-color: #e2e6ea;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        a{
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Détails de la Commande</h1>

        <!-- Card for Order Details -->
        <div class="card">
            
            <div class="card-header">
        <a href="{{ route('orders.index') }}" class="btn btn-back mt-3">Retourner à la liste des commandes</a>

                <h5 class="mb-0">Informations de la Commande</h5>


            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <p><strong>ID:</strong> {{ $order->id }}</p>
                            <p><strong>Nom du client:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Email du client:</strong> {{ $order->customer_email }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <p><strong>Status:</strong> {{ $order->status }}</p>
                            <p><strong>Total:</strong> {{ $order->total }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Produit</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
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
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Back Button -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-6dO4enFWJz5X9AGs4yX9pbg9OfZKt9fO4Gnk5bUpeH8OeX0pV1HYNTFRaANllD" crossorigin="anonymous"></script>
</body>

</html>
