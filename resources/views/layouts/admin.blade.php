<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #EDF2EE;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            background-color: #002603; /* Couleur de fond de la barre latérale */
            color: #EDF2EE; /* Couleur du texte dans la barre latérale */
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            background-color: #618062; /* Couleur de fond de l'en-tête de la barre latérale */
            color: #EDF2EE; /* Couleur du texte de l'en-tête */
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #sidebar-wrapper .list-group-item {
            background-color: #002603; /* Couleur de fond des éléments de la liste */
            color: #EDF2EE; /* Couleur du texte des éléments de la liste */
            border: none; /* Suppression des bordures */
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #618062; /* Couleur de fond au survol des éléments de la liste */
            color: #EDF2EE; /* Couleur du texte au survol des éléments de la liste */
        }

        #page-content-wrapper {
            min-width: 100vw;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }
        .__menu-toggle{
            background: #002603;
            color: #EDF2EE;
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
    <div class="sidebar-heading">Admin Panel</div>
    <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action">
            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-users mr-2"></i>Utilisateurs
        </a>
        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-tags mr-2"></i>Catégories
        </a>
        <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-box mr-2"></i>Produits
        </a>
        <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-shopping-cart mr-2"></i>Commandes
        </a>
        <!-- Ajoutez d'autres liens de navigation ici -->
    </div>

    </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="__menu-toggle btn" id="menu-toggle">Reduire le Menu</button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        @if(Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
        @endif
    </ul>
</div>

            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</body>
</html>
