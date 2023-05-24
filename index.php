<?php
session_start();
include('connection.php');

if($_SERVER['REQUEST_METHOD']== "POST"){
  $UserName=$_POST['UserName'];
  $Password= $_POST['Password'];

 
      //read from database
      $query = "select * from users where username='$UserName' limit 1";
      

      $result=mysqli_query($con,$query);
      if($result){
           if($result && mysqli_num_rows($result)>0){
          $user_data = mysqli_fetch_assoc(($result));
          if($user_data['password'] === $Password){
              $_SESSION['active'] = $user_data;
              if ($UserName === "admin") {
                header("Location: admin.php");
              } else {
                header("Location: dashboard.php");
              }
          }else{
              echo 'Incorrect password';
          }
           }
      }      
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<style>
*{
    padding: 5px;
    margin: 3px;
    box-sizing: border-box;
  }
  .error {color: #FF0000;}
  .container{
    border: 2px solid grey;
    position: absolute;
    top: 15%;
    left: 40%;
    align-content: center;
    background-color: wheat;
  }
  .Title{
    position: absolute;  
    left: 30%;
    font-size: 20px;
    margin: 10px; 
  }
  .inputs{
    position:relative;
    left: 10%;
  }
  .Submit_button{
    position: absolute;
    left: 30%;
    top: 68%;
  }
</style>
<body>
  <div class="container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="Title">LOGIN</div>
      <br/>
      <br>
      <br>
      <div class="inputs">
        <input type="text" name="UserName" placeholder="Enter Username" required>
      </div>
      <br/>    
      <div class="inputs">
        <input type="password" name="Password" placeholder="Enter your password" required>
      </div>
      <br/> 
      <?php if(isset($error)) { echo "<div class='error'</div>"; } ?>
      <div class="Submit_button">
        <button>login</button>
      </div>   
      </form>

      <br>
      <br>
      <div class="sign_up">
        <a href="./signup.php">Don't have an account? Sign Up</a>
      </div>
    </form>
  </div>     
</body>
</html>
