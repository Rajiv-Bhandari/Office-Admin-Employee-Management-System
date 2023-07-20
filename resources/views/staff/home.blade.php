<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    /* Custom styles */
    body {
      background-color: #f0f7f6;
      font-family: 'Arial', sans-serif;
    }
    
    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    
    h1 {
      font-family: 'Pacifico', cursive;
      font-size: 36px;
      color: #336699;
      margin-bottom: 30px;
      text-align: center;
    }
    
    .btn-creepy {
      background-color: #ffffff;
      border: none;
      padding: 15px 30px;
      font-size: 18px;
      font-weight: bold;
      color: #555555;
      text-transform: uppercase;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
      margin-bottom: 10px;
      width: 100%;
    }
    
    .btn-creepy:hover {
      background-color: #3ebd70;
      color: #ffffff;
    }
    
    .btn-container {
      display: flex;
      flex-direction: column;
      gap: 10px;
      justify-content: center;
    }
    
    .btn-container form {
      width: 200px;
      margin: 0 auto;
    }
    
    .admin-text {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 48px;
      font-weight: bold;
      color: #336699;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .logout-button {
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .contact-button {
      position: absolute;
      top: 20px;
      right: 110px;
    }
    .profile-button{
      position: absolute;
      top: 20px;
      right: 210px;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="/logout" class="btn btn-danger logout-button">Logout</a>
    
    <div class="admin-text">
        <h1>Hello, {{ Auth::user()->name }}</h1>
    </div>
    
    <div>
        @if(session()->has('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
        @endif
    </div>
    
    <a href="{{route('contatpage')}}" class="btn btn-primary contact-button">Contact</a>
    
    <div class="profile-button">
      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Profile
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{route('staffprofile')}}">Update Profile</a>
        <a class="dropdown-item" href="{{route('changepassword')}}">Change Password</a>
      </div>
    </div>
    
    <h1>Welcome to our company.</h1>
    
 
    <div class="btn-container">
      <form action="{{ route('staffdepartmentdetails') }}" method="GET">
        @csrf
        <button class="btn-creepy">View Department</button>
      </form>
      
      <form action="{{ route('staffviewstaff') }}" method="GET">
        @csrf
        <button class="btn-creepy">View Staff</button>
      </form>
    </div>
  
  </div>
  
<script>
  // Variable to store the last status of the session
  let lastStatus = true;

  // Function to handle the session status check
  function checkSessionStatus() {
      fetch('/check-session')
          .then(response => {
              if (response.status === 401) {
                  // If the session has expired, update the lastStatus variable
                  lastStatus = false;
                  window.location.href = '/logout';
              } else {
                  // If the session is still valid, update the lastStatus variable
                  lastStatus = true;
              }
          })
          .catch(error => {
              console.error('Error checking session status:', error);
          });
  }

  // Check if the session has expired every 5 seconds
  setInterval(checkSessionStatus, 5000); // 5 seconds interval

  // Handle the beforeunload event to log out from other tabs
  window.addEventListener('beforeunload', () => {
      if (lastStatus) {
          // If the session is still valid, set the session_token to null in the staff table
          fetch('/clear-session-token', { method: 'POST' })
              .catch(error => {
                  console.error('Error clearing session token:', error);
              });
      }
  });
</script>


  <!-- Bootstrap JS (optional, if you need any JavaScript functionality) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
