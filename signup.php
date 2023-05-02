
<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "salesandmarketing";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

// Check if passwords match
if ($password !== $confirm_password) {
  echo "Error: Passwords do not match";
  exit();
}

// Hash password
//$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    $user_id = mysqli_insert_id($conn);
  echo "New user created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<style>
    *{
        padding: 5px;
        margin: 3px;
        box-sizing: border-box;

    }
    .error {color: #FF0000;}
    .container{
        border: 1px solid black;
        position: absolute;
        top: 10%;
        left: 40%;
        align-content: center;
        background-color: wheat;

    }
    .Title{
        position: absolute;  
         left: 12%; 
         font-size: 20px;
         margin: 10px;
    }
    .inputs{
        position: relative;
        top: 10%;
        left: 8%;
    }
    .Submit_button{
      position: absolute;
      left: 35%;
      top: 78%;
      
    }
</style>


<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"   action="./Dashboard.php" method="POST">
            <div class="Title">Register To The Bar</div>
            <br/>
            <br>
            <br>
            <div class="inputs">
                <input type="text" name="username" placeholder="Enter Username" required>
                
            </div>
            <br/>    
            <div class="inputs">
                <input type="email" name="email" placeholder="Enter your Email" required>
            </div>
            <br/>    
            <div class="inputs">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <br/>    
            <div class="inputs">
                <input type="password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
           

            <br>
            <br>
            <div class="Submit_button">
                <button>Sign Up</button>
            </div>  
            <br> 
            <div class="login">
            <a href="./index.php">Already have an account?Login</a>
  </div>


        </form>

    </div>
    
</body>
</html>