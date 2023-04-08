<!DOCTYPE html>
<html>
<head>
 
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	
	<title>Taker Login</title>
  <?php

if(isset($_POST['s']))
{
    session_start();
    $_SESSION['x']=1;
    $conn=mysqli_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysqli_error());
    }
    mysqli_select_db($conn,"on_the_go incident reporter");
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST['email'];
        $pass=$_POST['password'];
        $result=mysqli_query($conn,"SELECT T_id,T_pass FROM Taker where T_id='$name'");
        
        if(mysqli_num_rows($result)==0)
        {
             $message = "Id or Password not Matched.";
             echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else 
        {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass, $row['T_pass'])) {
                header("location:TakerHome.php");
                exit; // Make sure to exit after redirecting
            }
            else {
                $message = " Password not Matched.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    }                
}

?>


</head>
<body style="color: black;background-image: url(pictures/Taker.jpg);background-size: 100%;background-repeat: no-repeat;back">
	<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#3b3b3b;">
  <div class="container">
    <div class="navbar-header">
     
      <a class="navbar-brand" href="home.php"><b>On_The_Go Incident Reporter</b></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="official_login.php">Official Login</a></li>
        <li class="active"><a href="Takerlogin.php">Taker Login</a></li>
      </ul>
    
    </div>
  </div>
 </nav>
 <div  align="center" >
  <div class="form" style="margin-top: 15%">
    <form method="post">
  <div class="form-group" style="width: 30%">
    <label for="exampleInputEmail1"  ><h1 style="color:white">Taker Id</h1></label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" size="5" placeholder="Enter user id" required>
     </div>
  <div class="form-group" style="width:30%">
    <label for="exampleInputPassword1"><h1 style="color:white">Password</h1></label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
  </div>
  
  
  <button type="submit" class="btn btn-primary" name="s">Login</button>
</form>
  </div>
</div>
<div style="position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color:#3b3b3b;
            color: white;
            text-align: center;">
            <h4 style="color: white;">&copy <b>On_The_Go Incident Reporter</b></h4>
         </div>

</body>
</html>