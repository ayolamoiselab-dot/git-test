<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard&Gestion</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

  





</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/dashboard')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Facturation
            </div>

            @if(Auth::user()->role == 'admin' || Auth::user()->is_admin)
            <!-- Section réservée aux administrateurs -->
            <!-- Heading -->
            <div class="sidebar-heading">
                Facturation
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>GESTION</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Scolarité:</h6>
                        <a class="collapse-item" href="{{url('/inscription')}}">INSCRIPTION</a>
                        <a class="collapse-item" href="{{url('/menuscolarite')}}">Mise à jour</a>
                        <h6 class="collapse-header">Cantine:</h6>
                        <a class="collapse-item" href="{{url('/menucantine')}}">INSCRIPTION</a>
                        <a class="collapse-item" href="{{ url('/pagemiseajourcantine') }}">Mise à Jour</a>
                        <a class="collapse-item" href="{{route('cantine_jour.form')}}">Cantine Jour</a>
                        <h6 class="collapse-header">Transport:</h6>
                        <a class="collapse-item" href="{{url('/menutransport')}}">INSCRIPTION</a>
                        <a class="collapse-item" href="{{ url('/pagemiseajourtransport') }}">Mise à jour</a>
                        <h6 class="collapse-header">Piscine:</h6>
                        <a class="collapse-item" href="{{url('/menupiscine')}}">INSCRIPTION</a>
                        <a class="collapse-item" href="{{ url('/pagemiseajourpiscine') }}">Mise à jour</a>
                        <h6 class="collapse-header">Informatique:</h6>
                        <a class="collapse-item" href="{{url('/menuinformatique')}}">INSCRIPTION</a>
                        <a class="collapse-item" href="{{ url('/pagemiseajourinformatique') }}">Mise à jour</a>


                        <h6 class="collapse-header">GESTION FAVORISATION</h6>
                        <a class="collapse-item" href="{{url('/favorisation')}}">FAVORISER DES ELEVES</a>
                        <a class="collapse-item" href="{{ url('/favorisemaj') }}">Mise à jour</a>
                        <a class="collapse-item" href="{{ url('/favorisation/liste/favorises') }}">Liste des favorisés</a>
                    </div>
                </div>
            </li>




            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                AUDIT
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Traçage Transactions</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">SCOLARITÉ:</h6>
                        <a class="collapse-item" href="{{ route('recherche.recu') }}">Reçus Scolarité</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Cantine:</h6>
                        <a class="collapse-item" href="{{ route('recherche.recucant') }}">Reçus Cantine</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Transport:</h6>
                        <a class="collapse-item" href="{{ route('recherche.recutrans') }}">Reçus Transport</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Cantine Jour:</h6>
                        <a class="collapse-item" href="{{ route('recherche.recucantjour') }}">Reçu Cantine Jour</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Piscine:</h6>
                        <a class="collapse-item" href="404.html">Reçu Piscine</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{url('/requetes')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>REQUETES</span></a>
            </li>

            @endif

            @if(Auth::user()->role == 'secretaire')
            <!-- Section réservée aux secrétaires -->
            <div class="sidebar-heading">
                VENTES ET AUTRES
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>GESTION</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ventes:</h6>
                        <a class="collapse-item" href="{{ route('ventes.create') }}">Nouvelle Vente</a>
                        <a class="collapse-item" href="{{ route('ventes.jour') }}">Ventes Du Jour</a>
                        <a class="collapse-item" href="{{ route('showAddStockForm') }}">Ajouter Stock</a>
                        <a class="collapse-item" href="{{ route('showRemainingQuantities') }}">Quantités Restantes</a>
                        <h6 class="collapse-header">Decaissements:</h6>
                        <a class="collapse-item" href="{{url('/decaissements/nouveau')}}">Nouveau Decaissement</a>
                        <a class="collapse-item" href="{{route('decaissements.jour')}}">Decaissements Du Jour</a>
                        <a class="collapse-item" href="{{url('/decaissement/rechercher')}}">Rechercher Un Décaissement</a>
                        <a class="collapse-item" href="{{url('/decaissement/periodiques')}}">Liste Decaissements Périodiques</a>
                    </div>
                </div>
            </li>

              <!-- Nav Item - Charts -->
              <li class="nav-item">
                <a class="nav-link" href="{{url('/requetes')}}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>REQUETES</span></a>
            </li>
            @endif


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Contacter Developpeur</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">

            </div>


            <!-- End of Sidebar -->
        </ul>
        <!-- End of Sidebar -->



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name
                                    }}</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logoutpro') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>

                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <!-- Le contenu -->
                    @yield("content")


  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
                    