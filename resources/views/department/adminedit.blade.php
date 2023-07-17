<!DOCTYPE html>
<html>
<head>
    <title>Admin Edit Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f7f6;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            color: #336699;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #336699;
            border-color: #336699;
        }

        .btn-primary:hover {
            background-color: #3ebd70;
            border-color: #3ebd70;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{route('details')}}" class="btn btn-primary">Back</a>
        </div>
        <h2>Department Edit Page</h2>
        <form method="post" action="{{route('adminupdate', ['department' => $department])}}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$department->name}}" required>
            </div>
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" class="form-control" id="short_code" name="short_code" value="{{$department->short_code}}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
