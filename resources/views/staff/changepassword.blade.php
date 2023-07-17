<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
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
            position: relative; /* Added */
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
        
        .btn-back {
            position: absolute; /* Added */
            top: 10px; /* Adjust as needed */
            right: 10px; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <div>
            @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif
        </div>
        <a href="{{ route('staff.home') }}" class="btn btn-primary btn-back">Home</a>
        <form method="post" action="{{route('updatepassword')}}">
            @csrf
            
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="NewPassword" name="NewPassword" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
</html>
