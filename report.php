<?php
session_start();

if(isset($_SESSION['attendance_userid']))
{
$user = $_SESSION['attendance_userid'];
$conn = mysqli_connect("localhost","id19436597_sklm_att","@I&7ANIviF0PHW\|","id19436597_rgukt_att_sys_db");
$query = "select * from users where username = '$user' limit 1 ";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)!=0)
{

    $user_data = mysqli_fetch_assoc($result);
    

}else
{ 

        $_SESSION['rguktlib_userid'] = 0;
        header("Location: login.php");
        die;

    }
}

 else
{

    header("Location: login.php");
    die;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance-Report</title>
    <style>
        *{
            margin: 0;padding: 0;
       font-size: 23px;
        }  
        
        .header{
    background-color: rgb(233, 212, 23);
    width:100%;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    position: fixed;
    top: 0;
}
.main_nav ul{
    display: flex;
    padding: 10px 20px;
    justify-content: space-around;
    list-style: none;
   
    
    
    }
 
    .main_nav li{
         padding: 0px 20px;
    }
    .main_nav a:hover{
      cursor: pointer;
      color: red;
      font-weight: 600;
    }
   a{
    text-decoration: none;
    color: whitesmoke;
   }
   #drop_label{
    display: none;
   }
   #phone_drop{
    display: none;
   }
   .header{
    z-index: 1;
   }
   #start{
        margin-top: 70px;
      }
      @media only screen and (max-width: 850px){
         #name{
          display: none;
         }
         .main_nav ul{
          margin-top: 47px;
          margin-left: 100%;
          transition: margin 1s;
         }
         #drop_label{
          display: block;
          margin: auto 0;
          margin-left: 20%;
          
         }
          #output{
            height: 90vw;
            transform: rotate(-90deg);
                   }
         #phone_drop:checked~.main_nav ul{
          margin-left: 0;
  
         }
         .main_nav ul{
          display: flex;
          flex-direction: column;
          position: absolute;
          left: 0;
          width: 100%;
          text-align: center;
          background-color:  aqua;
         
         }
         .main_nav a{
             padding: 10px;
             margin-right: 40px;
             color: black;
             z-index: 1; 
         }

   }
    </style>
</head>

<?php
if(isset($_POST['sub_btn'])){
  $course = $_POST['class'];
  $sem = $_POST['sem'];
  $section = $_POST['section'];
  $conn = mysqli_connect("localhost","id19436597_sklm_att","@I&7ANIviF0PHW\|","id19436597_rgukt_att_sys_db");
  $query = "select * from links where course = '$course' and sem = '$sem' and section='$section' limit 1 ";
  $result = mysqli_query($conn,$query);
 if(mysqli_num_rows($result)!=0)
  {
 
    $user_data = mysqli_fetch_assoc($result);
    $link = $user_data['norm_link'];
    $_SESSION['api_rep_key'] = $link;

 
 }
 else{
     echo "<script>alert('NO Records Found')</script>";
 }
 
 }

?>

<body>
    <div class="header">
        <h3 style="padding: 9px;">RGUKT&nbsp;ATTENDANCE&nbsp;</h3>
        <label for="phone_drop" id="drop_label">&#9776;</label>
        <input type="checkbox" name="phone_drop" id="phone_drop">
        <nav class="main_nav">
          <ul>
            <a href="index.php"><li>HOME</li></a>
            <a href="search.php"><li>SEARCH</li></a>
            <a href="report.php" target="_blank"><li>REPORT</li></a>
            <a href="modify.php" target="_blank"><li>MODIFY</li></a>
            <a href="about.html" target="_blank"><li>ABOUT</li></a>
            <a href="https://www.rguktsklm.ac.in" target="_blank"><li>RGUKTSKLM</li></a>
            <a href="logout.php"><li>LOGOUT</li></a>
          </ul>
        </nav>
       </div>
    
        <center style="border: solid 1px;" id="start">
    
    <p>Please Reload the page before searching for New Class Attendance Report</p>
     <br>
    Teacher:<?php print_r($user_data['name']) ?>
    <br>
    <br>
    <form action="reportwork.php" method="POST">
    <label for="SUBJECT">SUBJECT:</label>
    <select class="subject" name="subject" id="subject" required>
      <option value="telugu">TELUGU</option>
      <option value="english">ENGLISH</option>
        <option value="mathematics">MATHEMATICS</option>
        <option value="physics">PHYSICS</option>
        <option value="chemistry">CHEMISTRY</option>
        <option value="information technology">IT</option>
        <option value="biology">BIOLOGY</option>
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <label for="CLASS">COURSE:</label>
    <select class="cla" name="class" id="class" required>
        <option value="puc-1">PUC-1</option>
        <option value="puc-2">PUC-2</option>
    </select>
    <br><br>
    <label for="SEM">SEMESTER:</label>
    <select class="sem" name="sem" id="sem" required>
        <option value="sem-1">SEM-1</option>
        <option value="sem-2">SEM-2</option>
    </select>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <label for="SECTION" >SECTION:</label>
    <select class="section" name="section" id="section" required >
      <option value="B1">B1</option>
      <option value="B2">B2</option>
      <option value="B3">B3</option>
      <option value="B4">B4</option>
      <option value="B5">B5</option>
      <option value="B6">B6</option>
      <option value="B7">B7</option>
      <option value="B8">B8</option>
      <option value="B9">B9</option>
    </select>
    <br><br>
    <input type="submit" value="Search" name="sub_btn" onclick="search();">
  </form>
    <br><br>
    
   
    </center>
    <!--<footer style="text-align: center;background-color: #343a40;padding: 10px 0;position:sticky;width: 100%; bottom: 0;">© 2022 RGUKT-AP., Srikakulam Campus | Designed By: <a href="https://www.instagram.com/dileepadari/">Delhi</a> </footer>-->
</body>
</html>