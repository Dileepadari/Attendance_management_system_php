<?php
session_start();
    $_SESSION['api_mod_key'] = "";
    $_SESSION['api_rep_key'] = "";
    $_SESSION['api_search_key'] = "";
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
    <title>ATTENDANCE-RGUKTSKLM</title>
   
<link
      rel="stylesheet"
      
      crossorigin="anonymous"
    />
    <style>
      *{
       font-size: 23px;
      }
      *{
        margin: 0;
        padding: 0;
      }
      .start{
        
        display:flex;
        flex-wrap:wrap;
        justify-content:space-around;
      }
      #centers{
        margin-top: 60px;
      }
      .inps{
        padding: 15px
      }
        .invisible{
            visibility:hidden!important
        }
        .form-group{
          display: flex;
          flex-wrap: wrap;
            justify-content: space-evenly;
            
            
        }
        .unchange{
          display: flex;
          flex-wrap:wrap;
            justify-content: space-around;
            
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
        font-size: 22px;
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
   /*code for phone*/
   @media only screen and (max-width: 850px){
         #name{
          display: none;
         }
         .main_nav ul{
          margin-top: 60px;
          margin-left: 100%;
          transition: margin 1s;
         }
         #drop_label{
          display: block;
          margin: auto 0;
          position:absolute;
          right:30px;
          top:20px;
          
          
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
   /*code for loader*/
   #loader {
    display: none;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; 
  animation: spin 2s linear infinite;
}


@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
    </style>
</head>

<body>
  <div class="header">
    <h3 style="padding: 9px;">RGUKT&nbsp;ATTENDANCE&nbsp;</h3>
    <label for="phone_drop" id="drop_label">&#9776;</label>
    <input type="checkbox" name="phone_drop" id="phone_drop">
    <nav class="main_nav">
      <ul>
        <a href="index.php"><li>HOME</li></a>
        <a href="search.php"><li>SEARCH</li></a>
        <a href="report.php" ><li>REPORT</li></a>
        <a href="modify.php" ><li>MODIFY</li></a>
        <a href="about.html" ><li>ABOUT</li></a>
        <a href="https://www.rguktsklm.ac.in" target="_blank"><li>RGUKTSKLM</li></a>
        <a href="logout.php"><li>LOGOUT</li></a>
      </ul>
    </nav>
   </div>

    <center style="border: solid 1px;" id="centers">
    
    <br>
    Teacher:<?php print_r($user_data['name']) ?>
    <br>
<br>
<p>Please Reload the page before Entering New Class Attendance</p>
<br>
<form action="main.php" id="start" method="POST">
  <div class="start">
<div class="inps">

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
</div>
<div class="inps">
<label for="CLASS">COURSE:</label>
<select class="cla" name="class" id="class" required>
    <option value="puc-1">PUC-1</option>
    <option value="puc-2">PUC-2</option>
</select>
</div>
<div class="inps">
<label for="SEM">SEMESTER:</label>
<select class="sem" name="sem" id="sem" required>
    <option value="sem-1">SEM-1</option>
    <option value="sem-2">SEM-2</option>
</select>
</div>
<div class="inps">
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
</div>
</div>
</div>
<br><br>
<input type="submit" value="Search" name="submit_btn" onclick="search();">
  </form>
<br><br>
</center>

  <br>
  
<div class="container my-5" id="hide" style="display: none;">
  
    <form
    data-stein-url="https://api.steinhq.com/v1/storages/62f0e81ebca21f053ea77753/english"
      class="my-3"
      id="sheet-form" 
    >
    <div class="unchange">
          <div class="form-group">
        <label for="title-input">DATE:</label>
        <input
        type="date"
          id="date"
          name="S. No"
          class="form-control form-control-lg" required
        />
      </div>
      <div class="form-group">
        <label for="period">PERIOD:</label>
        <select class="form-control" name="period" id="subject" required>
            <option value="period-1">PERIOD-1</option>
            <option value="period-2">PERIOD-2</option>
            <option value="period-3">PERIOD-3</option>
            <option value="period-4">PERIOD-4</option>
            <option value="period-5">PERIOD-5</option>
            <option value="period-6">PERIOD-6</option>
            <option value="period-7">PERIOD-7</option>
            <option value="period-8">PERIOD-8</option>
        </select>
      </div>
    </div>
    <br>
    <div id="allforms">
      <div class="form-group" style="margin-right: 50px;">
        <div>S No:</div>
        <div style="margin-right: 50px;">College ID NO:</div>
        <div style="margin-right: 50px;" id="name">Name of the Student:</div>
        <div class="attend">ATTENDANCE:</div>
             <label for="link-input-lab">Present</label>
        <input type="radio" id="link-input-rad" name="1" class="form-control-rad" disabled/>
        <label for="link-input-lab">Absent</label>
        <input type="radio" id="link-input-rad" name="1" class="form-control-rad" disabled/>
    
   
</div>
<br>
      </div>
      <br><br>
      <button type="reset" class="btn btn-primary" id="reset">RESET</button>
      &nbsp;&nbsp;&nbsp;
      <button type="submit" class="btn btn-primary" id="submit" onclick="run();">
        SUBMIT
      </button>
    </form>
    <div
      class="alert alert-success invisible"
      role="alert"
      id="completed-alert"
    >
    <br>
      ATTENDANCE SUCCESSFULLY REGISTERED!
    </div>
    
  </div>
  
  

</center>
<!--<footer style="text-align: center;background-color: #343a40;padding: 10px 0;position:absolute;bottom: 0px;  width: 100vw; ">© 2022 RGUKT-AP., Srikakulam Campus | Designed By: <a href="https://www.instagram.com/dileepadari/">Delhi</a> </footer>-->
</body>
<script src="https://unpkg.com/stein-expedite@0.1.0/dist/index.js"></script>

</html>