<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/user">{{ Auth::user()->name }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'home' ? 'active' : '' }}"
                        {{ $page == 'home' ? 'aria-current="page"' : '' }} href="/user">Home</a>
                </li>
                @if ($start)
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 'soal' ? 'active' : '' }}"
                            {{ $page == 'soal' ? 'aria-current="page"' : '' }}
                            href="/user/soal" onclick="return confirm('Anda akan memulai pertanyaan!')">Soal</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ $page == 'materi' ? 'active' : '' }}"
                        {{ $page == 'materi' ? 'aria-current="page"' : '' }} href="/user/materi">Materi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
