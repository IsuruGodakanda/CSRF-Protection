<?php

session_start();

require_once 'token.php';

 $display_msg = "";

  if(isset($_POST['fname'], $_POST['lname'], $_POST['csrf_token'])){

      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $csrf_token = $_POST['csrf_token'];

      if(!empty($fname) && !empty($lname) && !empty($csrf_token))
	  {
        if(Token::check_token($csrf_token))
		{
          $msg = "Updated Successfully! " ;
          $display_msg = "<p class=\"text-success\"><strong>".$msg."</strong></p>";
        }
        else{
          $msg = "Error Invalid Token";
          $display_msg = "<p class=\"text-danger\"><strong>".$msg."</strong></p>";
        }
      }
      else{
        echo "<script>alert('Check your details');</script>";
      }
  }




?>


<html>

	<head>
		<meta charset="UTF-8">
		<title>Update user</title>
		<link rel="stylesheet" href="style.css">
	</head>

<body>
	<div id="home">
	 <?php
        if (session_id() == '' || !isset($_SESSION['logeduser'])) { 
          header('Location: ./index.php');
      ?>
      <?php
        } 
        else {
          echo "Hi, " . $_SESSION['logeduser'] . " : ";
      ?>
	<center>
	</br><Legend><text class="textprop">Edit
User
</text></legend></br>
<form action="" method ="post">
	<text class="textprop">Firstname:</text><input
type="text" name="fname" class="textbox"></br></br>
  	<text class="textprop">Lastname:</text><input
type="text" name="lname" class="textbox"><br></br>

<input id="login-username" type="hidden" class="form-control" name="csrf_token" value="<?php  echo $_SESSION["token"];  ?>">  </div>

<input type="submit" value="Update" /><input type="reset" value="Reset" />

   <a href="logout.php">Logout</a> 
</form>
		</center>
		 <?php
        echo $display_msg;
        }
		?>
		</div>
	<script type="text/javascript" src="./script.js"></script>
	
</body>
</html>