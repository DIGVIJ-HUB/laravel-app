<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    @include('backend.navbar')
    <div class="container" style="padding-top: 5rem">
        <div class="text-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add movie
            </button>
        </div> <br>
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
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Runtime</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Image</th>
                    <th scope="col">Publication Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                <tr>
                    <td>{{$movie->title}}</td>
                    <td>{{$movie->description}}</td>
                    <td>{{$movie->runtime}}</td>
                    <td>@if ($movie->rating == null)
                        No rating yet
                        @else
                        {{$movie->rating}}
                        @endif </td>
                    <td><img src="{{$movie->image}}" alt="Movie 1" style="height: 10rem"></td>
                    <td>{{$movie->publication_date}}</td>
                    <td>
                        <button type="button" id="edit" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal1" data-id='{{$movie->id}}' onclick="editMovie({{ $movie->id }})">
                            Edit
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal to add movie -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add movie</h5>
                </div>
                <div class="modal-body">
                    {{-- form --}}
                    <form action="{{url('admin/add-movie')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" id="title"
                                placeholder="Enter movie title">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"
                                placeholder="Enter movie description"></textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Runtime (HH:MM:SS)</label>
                            <input type="text" name="runtime" class="form-control" id="runtime"
                                placeholder="Enter movie runtime">
                            @error('runtime')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="url" name="image" class="form-control" id="image"
                                placeholder="Enter image url">
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Publication Date</label>
                            <input type="date" name="publication_date" class="form-control" id="publication_date"
                                placeholder="Enter movie publication date">
                            @error('publication_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal to edit movie -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit movie</h5>
                </div>
                <div class="modal-body">
                    {{-- form --}}
                    <form action="{{url('admin/update-movie')}}" method="post">
                        @csrf
                        <input type="number" name="movie_id" id="id" hidden>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" id="edit_title"
                                placeholder="Enter movie title">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="edit_description" rows="3"
                                placeholder="Enter movie description"></textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Runtime (HH:MM:SS)</label>
                            <input type="text" name="runtime" class="form-control" id="edit_runtime"
                                placeholder="Enter movie runtime">
                            @error('runtime')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="url" name="image" class="form-control" id="edit_image"
                                placeholder="Enter image url">
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Publication Date</label>
                            <input type="date" name="publication_date" class="form-control" id="edit_publication_date"
                                placeholder="Enter movie publication date">
                            @error('publication_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function editMovie(movieId) {
        document.getElementById("id").value = movieId;
        fetch(`/admin/movie-data/${movieId}`)
            .then(response => response.json())
            .then(data => {
                // Populate form fields with data
                document.getElementById('edit_title').value = data.title;
                document.getElementById('edit_description').value = data.description;
                document.getElementById('edit_runtime').value = data.runtime;
                document.getElementById('edit_image').value = data.image;
                document.getElementById('edit_publication_date').value = data.publication_date;
            });
    }
</script>
</html>