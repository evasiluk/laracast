<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Laracast</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

            @if(auth()->check())
            <li class="nav-item">
                <a class="nav-link" href="#">
                     <i class="fa fa-envelope-o">
                       <span class="badge badge-danger">{{ $notify_qnt }}</span>
                     </i>
                     Notifications
                </a>
            </li>
            @endif
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/faq">FAQ</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/personal">Personal Archive</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/ask">Ask</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Member
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/register">Register</a>
                    <a class="dropdown-item" href="/login">Login</a>
                    <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>