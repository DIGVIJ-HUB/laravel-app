<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div style="padding-left: 7rem">
        <a class="navbar-brand" href="/">Home</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @foreach ($notifications as $notification)
                    <a class="dropdown-item" href="{{url('movie',$notification->id)}}">
                        <h6 class="card-title">{{$notification->title}}</h6>
                        <p class="card-text">
                            {{substr($notification->description, 0, 50)}}...
                        </p>
                    </a>
                    <hr>
                    @endforeach
                </div>
            </li>
            </li>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>