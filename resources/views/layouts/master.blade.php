
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

   <!-- Favicon Icon -->
   <link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ url('img/logo.png') }} ">

  <title>My Wallet|Ecommerce</title>

  <link rel="stylesheet" href="/css/app.css">

  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
 
<div class="wrapper" id="app">
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
 

    <!-- SEARCH FORM -->
    
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" v-model="search" @keyup="searchit" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/home" class="brand-link">
      <img src="./img/logo.png" alt="LaraStart Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Virtual Wallet </span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                    <router-link to="/sent" class="nav-link">
                    <i class="nav-icon fas fa-arrow-alt-circle-up warning"></i>
                    <p>
                       Sent Funds History
                        <span class="right badge badge-danger">New</span>
                    </p>
                    </router-link>
                </li>


                <li class="nav-item">
                    <router-link to="/received" class="nav-link">
                    <i class="nav-icon fas fa-arrow-alt-circle-down green"></i>
                    <p>
                       Received Funds History
                       
                    </p>
                    </router-link>
                </li>

           

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-gift green"></i>
              <p>
                Gift a Friend
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link  to="/users" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Locate Friend</p>
                </router-link>
              </li>
             
            </ul>
          </li>

        

                <li class="nav-item">
                    <router-link to="/profile" class="nav-link">
                    <i class="nav-icon fas fa-user yellow"></i>
                    <p>
                       Profile
                        
                    </p>
                    </router-link>
                </li>


                <br>


                <li class="nav-item">
                    

                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                        <div class="row" style="margin-bottom:40px;">
                        <div class="col-md-8 col-md-offset-2">
                            <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> {{-- required --}}
                            <input type="hidden" name="orderID" value="345">
                            <input type="hidden" name="amount" value="1000000"> {{-- required in kobo --}}
                            <input type="hidden" name="quantity" value="3">
                            <input type="hidden" name="metadata" value="{{ json_encode($array = [
                              'user_id' => Auth::user()->id,
                              'amount' => 10000,
                              'balance' => Auth::user()->current_balance,
                            ]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                            <p>
                            <button class="btn btn-success btn-sm btn-block" type="submit" value="Pay Now!" data-toggle="tooltip" data-placement="top" title="You can only deposit N10000 at a time">
                            <i class="fa fa-plus-circle fa-sm"></i><span style="font-size:1.3em;">Fund my Wallet.</span>  
                            </button>
                            </p>
                        </div>
                        </div>
                </form>
                </li>





                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="nav-icon fas fa-power-off red"  ></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                    
                </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
       <h5 class="w-balance">
        Wallet Balance: <span class="btn btn-default" style="font-size:1.6rem;">N{{Auth::user()->current_balance}}</span>
       </h5> 
      <br><hr>
        
        <!--Router View -->
        <router-view></router-view>
        <!-- set progressbar -->
        <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="/">Obinna Johnson - Pre-Interview Evaluation Project: Wallet|Ecommerce Profile</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->


<script src="/js/app.js"></script>
</body>
</html>
