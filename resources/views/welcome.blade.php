<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="https://icons.iconarchive.com/icons/hadezign/hobbies/48/Movies-icon.png" type="image/x-icon">
    <title>Movie App</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    body {
        background-image: url('https://images.unsplash.com/photo-1536440136628-849c177e76a1?auto=format&fit=crop&q=80&w=1000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fG1vdmllJTIwYXBwc3xlbnwwfHwwfHx8MA%3D%3D');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top center;
        height: 100vh;
    }
</style>
<body>
    <h1>{{Auth::user()}}</h1>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card col-md-8 col-lg-4 col-sm-8 col-xs-8">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                {{-- form --}}
                <form action="{{url('login')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                </form>
                @if(Session::has('warning'))
                <div class="alert alert-warning">
                    {{ Session::get('warning') }}
                </div>
                @endif
                <div class="text-center pt-2">
                    <a href="{{url('register')}}">I don't have an account</a>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>
<script>
    const firebaseConfig = {
    apiKey: "AIzaSyCRUXWWIgfDnLWaGkQAEBGvXkQUENmkV0M",
    authDomain: "laravelapp-30ed1.firebaseapp.com",
    projectId: "laravelapp-30ed1",
    storageBucket: "laravelapp-30ed1.appspot.com",
    messagingSenderId: "796167181156",
    appId: "1:796167181156:web:2168397d313be6344ca071",
    measurementId: "G-RSD0PCM2PP"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const messaging = firebase.messaging();

</html>