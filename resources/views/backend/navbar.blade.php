<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div style="padding-left: 7rem">
        <a class="navbar-brand" href="dashboard">Home</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link"><i class="fas fa-user"></i></a>
            </li>
            <li class="nav-item">
                <form action="{{url('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-link nav-link">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>