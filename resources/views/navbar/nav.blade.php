<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <img src="https://getaldea.com/images/aldea-navbar-logo.svg" class="w-16 mr-4" alt="logo-img">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/">Iniciar Sesión</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/upload-file">Subir Archivo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Cerrar Sesión</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
