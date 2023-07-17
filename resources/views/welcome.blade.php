<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DevOps - Home</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    /* Custom styles */
    body {
      background-color: #eef3f2;
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
    }
    
    .jumbotron {
      background-color: #299a5e;
      text-align: center;
      padding: 50px;
      border-radius: 20px;
      margin-top: 150px;
    }
    
    .jumbotron h1 {
      font-family: 'Pacifico', cursive;
      font-size: 48px;
      color: #ffffff;
    }
    
    .jumbotron p {
      font-size: 24px;
      color: #555555;
    }
    
    /* Center align the button */
    .center-btn {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    
    /* Green button on hover */
    .btn-primary:hover {
      background-color: #3ebd70;
      border-color: #3ebd70;
    }

    .about-company {
      background-color: #f8f9fa;
      padding: 30px;
      border-radius: 20px;
      margin-top: 30px;
    }

    .about-company h2 {
      font-size: 36px;
      color: #336699;
    }

    .about-company p {
      font-size: 18px;
      color: #555555;
    }

    .contact-us {
      background-color: #f8f9fa;
      padding: 30px;
      border-radius: 20px;
      margin-top: 30px;
    }

    .contact-us h2 {
      font-size: 36px;
      color: #336699;
    }

    .contact-us p {
      font-size: 18px;
      color: #555555;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="/login" method="GET">
      @csrf
    <div class="jumbotron">
      <h1 class="display-4">Welcome to our company</h1>
      <p class="lead">Build the future digital!</p>
      
      <div class="center-btn">
        <input type="submit" class="btn btn-primary" value="Login"/>
      </div>
      
    </div>
    </form>

    <div class="container">
        <div class="row">
            <div class="col-md-6 about-company">
                <h2>DevOps Technology Pvt. Ltd</h2>
                <p>A company building experience that leads your business with the next digital platform.</p>
                <p>We are a curated team working on Creative Web Development, Web Design, Web Application, Software Development, and Overall Digital Improvement.</p>
            </div>
            <div class="col-md-6 contact-us">
                <h2>Contact Us</h2>
                <p>Email: info@devopstechnology.com.np</p>
                <p>Phone: +977-984174094</p>
            </div>
        </div>
    </div>
  </div>

  <!-- Bootstrap JS (optional, if you need any JavaScript functionality) -->
  


  <!-- Bootstrap JS (optional, if you need any JavaScript functionality) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
