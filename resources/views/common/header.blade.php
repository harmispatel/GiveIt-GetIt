
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
            <div class="media">
              <img src="{{ asset ('img/admin/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="" class="dropdown-item dropdown-footer">See All Messages</a>
          <li class="nav-item">
              <form action="{{route('logout')}}" method="POST">
              @csrf
              Hello, {{session('admin')}} |  
              {{-- <i class="fa fa-user text-danger profileBtn" data-toggle="modal" style="cursor: pointer;" data-target="#exampleModal" data-target-id="#" title="Profile"></i> --}}
              <a href="{{route('adminProfile.index')}}" ><i class="fa fa-user" id="btn" ></i></a>
                <a href="" class="nav-link">
                  <button class="btn btn-primary" type="submit" name="submit">Logout</button>
                </a>
              </form>
            </li>

          </div>
        </div>
      </li>
    </ul>
  </nav>
  <!--End Navbar -->

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}} --}}
            {{-- <script>
            $(document).ready(function(){
              $('#btn').click(function(){
                $('.adminProfile').toggle();
                
              });
            });
            </script> --}}

{{-- 
@if(auth()->user()->name)
{{ auth()->user()->name }}
@endif --}}