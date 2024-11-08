<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Food detail</title>
    <link rel="icon" type="image/x-icon" href="/storage/images/foods/burger.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E6B9A6;
        }

        .card {
            background-color: #EEEDEB;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Edit Food Item</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update', ['food' => $food->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="name" class="form-label">Food Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $food->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Food Image</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/*">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Food Description</label>
                                <textarea class="form-control" id="description" name="description">{{ $food->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Food Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" id="price" name="price"
                                        value="{{ $food->price }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
