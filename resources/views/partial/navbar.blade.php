

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                <img src="{{ asset('image/logo.png') }}" height="30" alt="Parkly Logo" loading="lazy" />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tentang-kami">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/parkir">Parkir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tutorial">tutorial</a>
                </li>
                <!-- Menu Admin -->
                @auth
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Admin</a>
                    </li>
                @endif
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">

                {{-- @if (auth()->check() && auth()->user()->id == 1)
      <a class="me-3" href="/admin">Admin</a>
      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
          <button type="submit">Logout</button>
      </form>
      @else --}}

                {{-- <!-- Icon -->
                <a class="text-reset me-3" href="#">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <!-- Notifications -->
                <div class="dropdown">
                    <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                        role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">Some news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </div> --}}
                <!-- Avatar -->
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                        id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        @php
                            $photo = Auth::user()->photo;
                            $photoUrl = $photo ? asset('storage/photo-user/' . basename($photo)) : null;
                        @endphp


                        @if ($photoUrl)
                            <img src="{{ $photoUrl }}" alt="Photo" class="rounded-circle img-fluid" height="25"
                                width="25">
                        @else
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                alt="avatar" class="rounded-circle img-fluid" height="25" width="25">
                        @endif
                        {{-- {{ auth()->user()->name }} --}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="/dashboard"><i class="fa-solid fa-user"></i> Profile</a>
                        </li>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/dashboard-bisnis"><i class="fa-solid fa-chart-line"></i>
                                Bisnis</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/parkiranku"><i class="fa-solid fa-square-parking"></i>
                                Parkiranku</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                {{-- @endif --}}
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
            @endauth
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
