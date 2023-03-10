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
<?php
$link = "";

 $course = $_POST['class'];
 $sem = $_POST['sem'];
 $section = $_POST['section'];
 $subject = $_POST['subject'];
 $conn = mysqli_connect("localhost","id19436597_sklm_att","@I&7ANIviF0PHW\|","id19436597_rgukt_att_sys_db");
 $query = "select * from links where course = '$course' and sem = '$sem' and section='$section' limit 1 ";
 $result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)!=0)
 {

   $user_data = mysqli_fetch_assoc($result);
   $link = $user_data['api_link'];

}


$api_link = $link.$subject;

?>
<script>
 
  var class_go = localStorage.getItem("class");
  if("<?php echo "$link";?>" == ""){
    alert("NO RECORDS FOUND")
    window.location = "index.php";
    
  }
  var api_link = "<?php print_r($api_link);?>;"
  document.write(`<center>
  <br>
  
  <div id="loader"></div>


  <div class="container my-5" id="hide" style="display: none;">
    <h1 style="text-transform:uppercase;"><b>Class:`+"<?php echo $subject?>"+`</b></h1>
    <br>
    <form
    data-stein-url="`+api_link+`"
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
      <!--  <label for="link-input-lab">Present</label>
        <input type="radio" id="link-input-rad" name="1" class="form-control-rad" disabled/>
        <label for="link-input-lab">Absent</label>
        <input type="radio" id="link-input-rad" name="1" class="form-control-rad" disabled/>-->
    
   
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
`)
</script>
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
        margin: 0%;
        padding: 0;
      }
      #start{
        margin-top: 60px;
      }
        .invisible{
            visibility:hidden!important
        }
        .form-group{
          display: flex;
            justify-content: space-evenly;
            
            
        }
        .unchange{
          display: flex;
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
   #hide{
       margin-top: 60px;
   }
   /*code for phone*/
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
          margin-left: 30%;
          
          
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
             color: black;
             margin-right: 40px;
             z-index: 1; 
         }

   }
   /*code for loader*/
   #loader {
    display: none;
    margin-top: 60px;
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
<script>
        
    
  
    
      document.getElementById("loader").style.display = "block";
      if(window.navigator.onLine==false){
        window.alert("Please connect to internet!");
      }
   
  var data;
// Defining async function
     async function getapi(api_link) {
    
    // Storing response
    try{
    const response = await fetch(api_link);
   
    // Storing data in form of JSON
    data = await response.json();
    var count = Object.keys(data[0]).length;
}
    catch(e) {
        alert("Error: check your internet connection ");
        window.location = "index.php";
        }
        
    document.getElementById("sheet-form").setAttribute("data-stein-url", api_link);
    document.getElementById("hide").style.display = "block";
        var i = 1;
        while (i<=(count-2)) {
        document.getElementById("allforms").innerHTML+=`<hr><br><div class="form-group">
        <div>`+i+`</div>
        <div>`+data[0][i]+`</div>
        <div style="width:200px;overflow:hidden;" id="name">`+data[1][i]+`</div>
        <div class="attend">
        <label for="link-input-lab">Present</label>
        <input type="radio" id="link-input-rad" name="`+i+`" class="form-control-rad" checked value="1"/>
        <label for="link-input-lab">Absent</label>
        <input type="radio" id="link-input-rad" name="`+i+`" class="form-control-rad" value="0"/>
    </div>`
    i += 1
        }
        
        run();
        
        
        document.getElementById("loader").style.display = "none";
        

        
   // show(data);
}
// Calling that async function
getapi(api_link);

       

    function run(){
      
      
    
      
        const submitButton = document.getElementById("submit"),
        requestCompletedAlert = document.getElementById("completed-alert"),
        form = document.getElementById("sheet-form");
        
      form.addEventListener("submit", () => {
        
        submitButton.disabled = true;
        requestCompletedAlert.classList.add("invisible");
        
      });

      form.addEventListener("ResponseReceived", event => {
        alert("Attendence is Successfully Recorded");
        if (event.detail.status === 200) {
          requestCompletedAlert.classList.remove("invisible");
          document.location = "index.php";
          
        }
        submitButton.disabled = false;
      });
      
    }
</script>
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
        <a href="about.html" target="_blank"><li>ABOUT</li></a>
        <a href="https://www.rguktsklm.ac.in" target="_blank"><li>RGUKTSKLM</li></a>
        <a href="" onclick="localStorage.setItem('rgu_user',' ')"><li>LOGOUT</li></a>
      </ul>
    </nav>
   </div>


   <!--<footer style="text-align: center;background-color: #343a40;padding: 10px; bottom: 0;">© 2022 RGUKT-AP., Srikakulam Campus | Designed By: <a href="https://www.instagram.com/dileepadari/">Delhi</a> </footer>-->
   
</body>
<script src="https://unpkg.com/stein-expedite@0.1.0/dist/index.js"></script>

</html>