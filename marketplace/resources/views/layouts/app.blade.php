<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">
  <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @auth
  <ul class="navbar-nav mr-auto">
      <li class="nav-item @if(request()->is('admin/orders*'))active @endif">
        <a class="nav-link" href="{{route('admin.orders.my')}}">My orders</a>
      </li>   
      <li class="nav-item @if(request()->is('admin/stores*'))active @endif">
        <a class="nav-link" href="{{route('admin.stores.index')}}">Store<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item @if(request()->is('admin/products*'))active @endif">
        <a class="nav-link" href="{{route('admin.products.index')}}">Products</a>
      </li>
      <li class="nav-item @if(request()->is('admin/categories*'))active @endif">
        <a class="nav-link" href="{{route('admin.categories.index')}}">Categories</a>
      </li>    
    </ul>
    <div class="my-2 my-lg-0">
    <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="{{route('admin.notifications.index')}}" class="nav-link">
                <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                <i class="fa fa-bell"></i>
              </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="#"onclick="event.preventDefault(); document.querySelector('form.logout').submit()">Logout</a>
                <form action="{{route('logout')}}" class="logout" method="post" style="display: none;">
                    @csrf
                </form> 
            </li>
            <li class="nav-item">
              <span class="nav-link">
                {{auth()->user()->name}}
              </span>
            </li>
        </ul>
    </div>
    @endauth
  </div>
</nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>


<script src="{{asset('js/app.js')}}"></script>
@yield('scripts')
</body>
</html>