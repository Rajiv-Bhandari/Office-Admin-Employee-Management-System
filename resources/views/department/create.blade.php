<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

    <title>Create Department</title>
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

        .form-title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            color: #336699;
        }

        .home-button {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 16px;
            padding: 10px 15px;
            background-color: #3ebd70;
            color: #ffffff;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <a href="{{route('home')}}" class="btn btn-primary home-button">Home</a>
    <div class="container">
        <h1 class="form-title">Create Department</h1>
        <form action="/create/department/store" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"/>
            </div>

            <div class="mb-3">
                <label for="short_code" class="form-label">Short Code</label>
                <input type="text" class="form-control" name="short_code" id="short_code" placeholder="Enter short code"/>
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Create"/>
            </div>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
