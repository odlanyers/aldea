<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <img src="https://getaldea.com/images/aldea-navbar-logo.svg" class="w-16 mr-4" alt="logo-img">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="position-absolute end-0">
            @auth
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><span class="nav-link">Hola {{ Auth::user()->name }}</span></li>
                @if(!Route::is('categorize'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categorize') }}">Categorizar gastos</a>
                </li>
                @endif
                @if(!Route::is('upload-file-view'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('upload-file') }}">Subir Archivo</a>
                </li>
                @endif
                @if(!Route::is('statistics'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('statistics') }}">Estadísticas</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" id="logout" href="#">Cerrar Sesión</a>
                    <form action="{{ route('logout') }}" id="form-logout" method="POST" style="display: none;" >
                        @csrf
                        <input type="hidden" name="_method" value="DELETE" />
                    </form>
                </li>
            </ul>
            @endauth
            @guest
            <span class="mx-5">Bienvenido. Inicia Sesión.</span>
            @endguest
            </div>
        </div>
    </div>
</nav>
