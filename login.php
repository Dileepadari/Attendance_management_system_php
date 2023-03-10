<?php
session_start();
$error = "";
if(isset($_POST["submit_btn"])){
    $conn = mysqli_connect("localhost","id19436597_sklm_att","@I&7ANIviF0PHW\|","id19436597_rgukt_att_sys_db");


		$username = addslashes($_POST['uname']);
		$password = addslashes($_POST['psw']);
		
		$query = "select * from users where username = '$username' limit 1 ";
        $result = mysqli_query($conn,$query);
		
		
		
		 $error = "";
		if(mysqli_num_rows($result)!=0)
		{
			
			$row = mysqli_fetch_assoc($result);
			
			if($password == $row['password'])
			{
				
				//create session data
				$_SESSION['attendance_userid'] = $row['username'];
				header("Location:index.php");
                die;
				
				

			}else
			{
				$error = "wrong email or password<br>";
			}
        }
		else
		{

			$error = "wrong email or password<br>";
		}

		
		
	}



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login page</title>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

form {
  border: 3px solid #f1f1f1;
  width:35%
}
form .lbl{
   margin-right:80%;
}   
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
    width: 80px;
    height: 80px;
  border-radius: 50%;
}

.container {
  padding: 16px;
  
}
.contain{
    display: flex;
    justify-content: space-around;
}
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 850px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
  form{
      width:100%;
  }
  .contain{
    display: block;
  }
}
</style>
</head>
<body>
<script>
    
    
       
    </script>
<h2 style="text-align:center;">USER LOGIN</h2>
<center>
<form action="" method="post">
  <div class="imgcontainer">
    <img src="images/academics.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname" class="lbl"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" id="uname" name="uname" required>

    <label for="psw"class="lbl"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="psw" name="psw" required>
        
    <button type="submit" name="submit_btn"onclick="ind();">Login</button>
   <p id="err"><?php echo $error?></p>
  </div>

  <div class="container contain" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <!--<span class="psw">Forgot <a href="#">password?</a></span>-->
  </div>
</form>
</center>
</body>

</html>