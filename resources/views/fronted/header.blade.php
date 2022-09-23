<header class="header" id="hedaer">
    <nav class="navbar navbar-expand-lg navbar-light bg-light wow animate__fadeInUp" data-wow-duration="1s">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('/img/fronted/logo.png') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">  
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('welcome*') ? 'active' : '' }}" href="{{url('welcome')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('giveit*') ? 'active' : '' }}" href="{{route('giveit')}}">Give It</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('getit*') ? 'active' : '' }}" href="{{route('getit')}}">Get It</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('aboutus*') ? 'active' : '' }}" href="{{url('aboutus')}}">About</a>
                    </li>

                    @guest
                    
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('login*') ? 'active' : '' }}"
                                href="{{ route('login') }}">Login</a>
                        </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('display-favorites*') ? 'active' : '' }}" href="{{route('displayfavorites')}}">Wishlist</a>
                    </li>
                        <li><form method="POST" action="{{ route('userlogout') }}">
                            @csrf
                            <button type="submit" class="btn logout-btn" name="submit">Logout</button>
                        </form></li>
                      <li class="nav-item d-flex align-items-center">
                        
                        <a href="{{ route('editprofile') }}"><i class="fa fa-user nav-link {{ Request::is('editprofile*') ? 'active' : '' }}"></i></a></li>
                          </div>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>
</header>
