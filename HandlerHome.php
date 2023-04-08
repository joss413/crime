
<meta http-equiv="refresh"  content="60;url=Handlerlogin.php">


<!DOCTYPE html>
<html>
<head>

<?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:Handlerlogin.php");
    
    $conn=mysqli_connect("localhost","root","");
   
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_select_db($conn,"on_the_go incident reporter");

 
      
  

  $result1=mysqli_query($conn,"SELECT location FROM p_handler");
  $q2=mysqli_fetch_assoc($result1);
  $location=$q2['location'];
  
  if(isset($_POST['s2']))
  {
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
      $cid=$_POST['cid'];
      
      $_SESSION['cid']=$cid;
      $qu=mysqli_query($conn,"SELECT  inc_status,location From p_handler where c_id='$cid'");
      
      $q=mysqli_fetch_assoc($qu);
      $inc_st=$q['inc_status'];
      $loc=$q['location'];
      
      if(strcmp("$loc","$location")!=0)
      {
        // $msg="Case Not of your Location";
       // echo "<script type='text/javascript'>alert('$msg');</script>";
       header("location:Handler_complain_details.php");
        
      }
      else if(strcmp("$inc_st","Unassigned")==0)
      {   
          header("location:Handler_complain_details.php");
          
      }
      else{
          header("location:Handler_complain_details1.php");
      }
  }
  }
  
  $query="SELECT id_no,c_id,type_crime,d_o_c,repo_time_and_date,location,description,inc_status,pol_status,p_id from p_handler order by c_id desc";
  $result=mysqli_query($conn,$query);  




  ?>

</head>
<body style="background-color: #dfdfdf">
	<nav  class="navbar navbar-default navbar-fixed-top" style="background-color:#3b3b3b;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><b> On_The_go Incident Reporter </b></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li ><a href="official_login.php">Official Login</a></li>
        <li ><a href="Handlerlogin.php">Handler Login</a></li>
        <li class="active"><a href="HandlerHome.php">Handler Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      
        <li><a href="Handler_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
 </nav>
 

    <form style="margin-top: 7%; margin-left: 40%;" method="post">
      <input type="text" name="cid" style="width: 250px; height: 30px; background-color:white;" placeholder="&nbsp Complaint Id" id="ciid" onfocusout="f1()" required>
        <div>
      <input class="btn btn-primary" type="submit" value="Search" name="s2" style="margin-top: 10px; margin-left: 11%;"> </br> </br>
        </div>
    </form>
    
    <div style="padding:50px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
      <tr>

        <th scope="col">Registration ID</th>
        <th scope="col">Complaint Id</th>
        <th scope="col">Type of Crime</th>
        <th scope="col">Date of Crime</th>
        <th scope="col">Reported Time and Date </th>
        <th scope="col">Location</th>
        <th scope="col">Descripition</th>
        <th scope="col">Complaint Status</th>
        <th scope="col">Police Status</th>
        <th scope="col">Police ID</th>
       
      </tr>
    </thead>

            <?php
              while($rows=mysqli_fetch_assoc($result)){

             ?> 

            <tbody style="background-color: white; color: black;">
      <tr>
          <td><?php echo $rows['id_no'];?></td>
          <td><?php echo $rows['c_id'];?></td>
          <td><?php echo $rows['type_crime'];?></td>     
          <td><?php echo $rows['d_o_c'];?></td>
          <td><?php echo $rows['repo_time_and_date'];?></td>
          <td><?php echo $rows['location'];?></td>
          <td><?php echo $rows['description'];?></td>
          <td><?php echo $rows['inc_status']; ?></td>
          <td><?php echo $rows['pol_status']; ?></td>
          <td><?php echo $rows['p_id']; ?></td>
      </tr>
    </tbody>
    
    <?php
    } 
    ?>
  
</table>
 </div>
    

 <div style="position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color:#3b3b3b;
            color: white;
            text-align: center;">
            <h4 style="color: white;">&copy <b> On_The_Go Incident Reporter | All Right Reserved </b></h4>
         </div>


	<title>Handler Homepage</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	
    <script>
     function f1()
        {
          var sta2=document.getElementById("ciid").value;
          var x2=sta2.indexOf(' ');
     if(sta2!="" && x2>=0)
     {
        document.getElementById("ciid").value="";
        alert("Blank Field not Allowed");
      }       
}
</script>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>