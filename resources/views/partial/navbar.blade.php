<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href=""
        ><img
          src="image/logo.png"
          class="navbar-brand logoku"
          alt="Parkly Logo"
        />Parkly</a
      >
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="d-flex">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/home"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/parkir">Parkir</a>
            </li>

            @auth
            <li class="nav-item dropdown">
              <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
              </button>
              <ul class="dropdown-menu dropdown-menu-light">
                <li>
                  <a class="dropdown-item" href="/dashboard">Dashboard</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Logout
                    </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
{{-------------------------------------------- End Logout Form ---------------------------------------------}}
              </li>
              </ul>
            </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="/login">Login</a>
                </li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </nav>

