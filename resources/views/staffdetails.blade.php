<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

    <title>Staff || Lists</title>
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
        <h1>Staffs Details</h1>
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
                        <th>Email</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Department Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staff as $staff)
                    <tr>
                        <td>{{ $staff->id }}</td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->short_code }}</td>
                        <td>{{ $staff->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($staff->dob)->diffInYears(\Carbon\Carbon::now()) }}</td>
                        <td>{{ $staff->address }}</td>              
                        <td>{{ $staff->status }}</td>
                        <td>{{ $staff->department->name }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('staff.adminedit', ['staff' => $staff])}}">Edit</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('staffdestroy', ['staff' => $staff]) }}">
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
