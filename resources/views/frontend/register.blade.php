<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
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
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card col-md-8 col-lg-4 col-sm-8 col-xs-8">
            <div class="card-body">
                <h5 class="card-title text-center">Register</h5>
                {{-- form --}}
                <form action="{{url('registration')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Enter your password">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Re-enter your password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>