<!DOCTYPE html>
<html>
<head>
    <title>Staff Edit Page</title>
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
            <a href="{{route('staffdetails')}}" class="btn btn-primary">Back</a>
        </div>
        <h2>Staff Edit Page</h2>
        <form method="post" action="{{route('staffdetailsupdate', ['staff' => $staff])}}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$staff->name}}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$staff->email}}" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" value="{{$staff->dob}}" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{$staff->address}}" required>
            </div>
            
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active" {{ $staff->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $staff->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="department_id">Department Name:</label>
                <select class="form-control" id="dept_id" name="dept_id" required>
                    @foreach($department as $department)
                        <option value="{{ $department->id }}" {{ $staff->dept_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
