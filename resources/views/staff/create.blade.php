<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

    <!-- Add Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Register</title>
    <style>
        body {
            background-color: #f0f7f6;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        }

        .form-title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
            color: #336699;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-home {
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

        .password-toggle {
            position: relative;
        }

        .password-toggle .toggle-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <a href="{{route('home')}}" class="btn btn-home">Home</a>
    <div class="container">
        <h1 class="form-title">Register a staff</h1>
        <div>
            @if(session()->has('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
             @endif
        </div>
        <form  action="/create/staff/store" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name*</label>
                <input type="text" class="form-control" name="name" id="name" >
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" class="form-control" name="email" id="email" >
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth*</label>
                <input type="date" class="form-control" name="dob" id="dob" >
                @error('dob')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address*</label>
                <input type="text" class="form-control" name="address" id="address" >
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group password-toggle">
                <label for="password">Password*</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" >
                    <span class="toggle-icon" onclick="togglePasswordVisibility('password')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group password-toggle">
                <label for="password_confirmation">Confirm Password*</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-write your password*">
                    <span class="toggle-icon" onclick="togglePasswordConfirmVisibility('password_confirmation')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status*</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dept_id">Department*</label>
                <select class="form-control" id="dept_id" name="dept_id" required>
                    @foreach($department as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

    <!-- Add Bootstrap JavaScript (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.querySelector(".toggle-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
    <script>
        function togglePasswordConfirmVisibility() {
            var passwordInput = document.getElementById("password_confirmation");
            var toggleIcon = document.querySelector(".toggle-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
