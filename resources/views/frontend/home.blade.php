<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    @if(Session::has('info'))
	<div class="alert alert-info" role="alert">
		{{Session::get('info')}}
	</div>
@endif
    {{-- Navbar --}}
    @include('frontend.navbar', compact('notifications'))

    <div class="container" style="padding-top:5rem">
        <div class="row pt-4">
            @foreach($movies as $movie)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $movie->image }}" class="card-img-top" alt="{{ $movie->title }}">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ Str::upper($movie->title) }}</h5>
                        <div class="text-center">

                            <span class="card-text">Publication Date: {{ $movie->publication_date }}</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('movie', $movie->id) }}" class="btn btn-primary mt-2">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>