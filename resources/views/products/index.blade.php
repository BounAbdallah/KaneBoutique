@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Produits</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-3">
            <div class="card">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text">Prix: {{ $product->price }} FCFA</p>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Voir Détails</a>
                    <button class="btn btn-success add-to-cart" data-product-id="{{ $product->id }}">
                        Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        
        $.ajax({
            url: '{{ route('cart.add') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: 1
            },
            success: function(response) {
                if(response.success) {
                    alert('Produit ajouté au panier!');
                    // Mettre à jour le compteur du panier si vous en avez un
                    // $('#cart-count').text(response.cartCount);
                }
            },
            error: function() {
                alert('Une erreur est survenue. Veuillez réessayer.');
            }
        });
    });
});
</script>
@endpush