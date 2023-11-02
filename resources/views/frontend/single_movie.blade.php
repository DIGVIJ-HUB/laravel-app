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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<body>
    {{-- navbar --}}
    @include('frontend.navbar',compact('notifications'))

    <div class="container" style="padding-top:5rem">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $movie->image }}" class="img-fluid" alt="{{ $movie->title }}">
            </div>
            <div class="col-md-8">
                <h1>{{ Str::upper($movie->title) }}</h1>
                <p class="pt-4"><strong>Description: </strong>{{ $movie->description }}</p>
                <p> <strong>Runtime:</strong> {{ $movie->runtime }} minutes</p>
                <p><strong> IMDB Rating: </strong>{{ $movie->rating }} <i class="far fa-star" data-value="4"></i></p>
                <p><strong>Publication Date: </strong> {{ $movie->publication_date }}</p>
                {{-- form --}}
                <form action="{{route('movie.submit_rating')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="range" class="form-control-range" id="rating" name="rating" min="0" max="10"
                            step="0.1">
                        <input name="movie_id" value="{{$movie->id}}" hidden />
                        <input id="ratingValue" name="rating" value="5" hidden />
                        <i class="fas fa-star" data-value="4"></i><span id="ratingVal">5</span> <br>
                        <button type="submit" class="btn btn-primary mt-2">Submit Rating</button>
                        @if(Session::has('warning'))
                        <div class="alert alert-warning">
                            {{ Session::get('warning') }}
                        </div>
                        @endif
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('rating').addEventListener('input', function() {
        document.getElementById('ratingValue').value = this.value;
        document.getElementById('ratingVal').innerText = this.value;
    });
</script>
</html>