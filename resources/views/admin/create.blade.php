<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Foods</title>
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
                        <h3 class="text-center">Create Food</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Food Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter food name">
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Food Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Food Image</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/*">
                                <small class="form-text text-muted">Upload an image file for the product.</small>
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Time:</label>
                                <input type="time" id="time" name="time" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Food Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter food description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Food Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="Enter food price">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
