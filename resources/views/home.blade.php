@extends('layouts.app')

@section('content')
<!-- Conteneur principal sans marges -->
<div class="container-fluid p-0">

    <!-- Slider -->
    <section class="mb-4">
        <div class="carousel-container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://media.istockphoto.com/id/174429248/fr/photo/l%C3%A9gumes-frais.jpg?s=612x612&w=0&k=20&c=mpa6hXTKtSX1I4QV6-PP1QKnL9yGD01ppSlk3v2mJdk=" class="d-block w-100" alt="Slide 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Premier Slide</h5>
                            <p>Description du premier slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://img.cuisineaz.com/350x280/2018/07/11/i140934-.jpeg" class="d-block w-100" alt="Slide 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Deuxième Slide</h5>
                            <p>Description du deuxième slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://img.mesrecettesfaciles.fr/2020-11/viandes-poissons-1.jpg" class="d-block w-100" alt="Slide 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Troisième Slide</h5>
                            <p>Description du troisième slide.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Filtres par Catégorie -->
    <div class="mb-4">
        <h2 class="text-center">Filtres par Catégorie</h2>
        <form method="GET" action="{{ route('home') }}" class="d-flex justify-content-center">
            <select name="category_id" class="form-select w-50" onchange="this.form.submit()">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Catégories Populaires -->
    <section class="categories-section py-5">
        <div class="container-fluid p-0">
            <h2 class="text-center mb-4">Catégories Populaires</h2>
            <div class="row no-gutters">
                @foreach($categories as $category)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card category-card h-100">
                            <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Produits -->
    <section class="products-section py-5">
        <div class=" container-fluid p-0">
            <h2 class="text-center mb-4">Produits</h2>
            <div class="row no-gutters">
                @foreach($products as $product)
                    <div class="_produits col-md-4 col-lg-3 mb-4">
                    <div class="card">
  <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"/>
    <a href="#!">
      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
    </a>
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $product->name }}</h5>
    <p class="card-text">{{ $product->description }}</p>
    <p class="card-text"><strong>{{ $product->price }} FCFA</strong></p>
    <button class="btn btn-primary" data-product-id="{{ $product->id }}">
                                    Ajouter au panier
                                </button>
  </div>
</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>














<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
                    Swal.fire({
                        icon: 'success',
                        title: 'Produit ajouté au panier!',
                        text: 'Vous pouvez continuer vos achats ou voir votre panier.',
                    });
                    // Mettre à jour le compteur du panier si vous en avez un
                    // $('#cart-count').text(response.cartCount);
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur est survenue. Veuillez réessayer.',
                });
            }
        });
    });
});
</script>

<style>
    body {
width: 100%;
    }
.carousel-container {
    margin-top: -25px;
    margin-left:-165px ;
    position: relative;
    overflow: hidden;
    width: 100vw; /* Full viewport width */
}

.carousel-inner {
    width: 100vw; /* Full viewport width */
}

.carousel-item img {
    object-fit: cover;
    width: 100%;
    height: 100vh; /* Full viewport height */
}

.category-card, .product-card {
    border: none;
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.category-card:hover, .product-card:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.btn-primary {
    background-color: #007bff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}
._produits{
    margin: 10px;
display: flex;
flex-direction: column;
text-align: left; 
}
</style>

@endsection
