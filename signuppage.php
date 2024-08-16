<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Kalnia+Glaze:wght@100..700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container mt-3">
    <h1 class="heading">Sign Up</h1>
    <form action="signup.php" method="post">
        <div class="mb-3">
            <label for="mail" class="form-label">Email address</label>
            <input type="email" class="form-control lbl" id="mail" name="mail" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control lbl" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control lbl" id="password" name="password" required>
            <input type="checkbox" class="check" onclick="myFunction()">&nbsp;&nbsp; Show Password
        </div>
        <br>
        <button type="submit" class="btn btn-white">Register</button>
        <button type="button" class="btn btn-white btns"><a href="login.php" class="btnss">Log in</a></button>
    </form>
  </div>
  <script>
    
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    
  </script>
</body>
</html>
