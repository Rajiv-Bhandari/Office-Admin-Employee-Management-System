<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

    <title>Departments || Lists</title>
    <style>
        .home-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{route('home')}}" class="btn btn-primary home-button">Home</a>
        <h1>Departments Details</h1>
        <div>
            @if(session()->has('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
             @endif
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($department as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->name }}</td>
                        <td>{{ $department->short_code }}</td>
                        <td>
                            <a href="{{route('adminedit', ['department' => $department])}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('destroy', ['department' => $department]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-danger" />
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
