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
 
 var class_go = "<?php echo $course." "; echo $sem." " ; echo $section." "; echo $subject?>"
  if("<?php echo "$link";?>" == ""){
    alert("NO RECORDS FOUND")
    window.location = "report.php";
    
  }
  var api_link = "<?php print_r($api_link)?>";
  document.write(`<center>
  <br>
  
  <div id="loader"></div>


  <div class="container my-5" id="hide" style="display: none;">
    <h1 style="text-transform:uppercase;"><b>Class:`+class_go+`</b></h1>
    <br>
         
    <table id="allforms" border="1">

   
    <tbody>
      <div class="form-group" style="margin-right: 50px;">
      <tr id="table_head"  ><th>S.NO</th></tr>
   
</div>
</tbody>
      </table>
    
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
      tbody{
        display:flex;
        
      }
      th,td{
        padding: 2px 40px;
        width: 200px;
      }
      td{
        text-align:center;
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
    var cont = Object.keys(data).length;
    
    }
    catch(e) {
        alert("Error: check your internet connection ");
        window.location = "report.php";
        }
        
        var i = 1;
    document.getElementById("hide").style.display = "block";
   p = 0;
    while(p<=(cont-1)){
        document.getElementById("table_head").innerHTML+=`
          <th style="position:sticky">`+data[p]['S. No']+`</th>
        
        `;
        p +=1;
    }
    document.getElementById("table_head").innerHTML+=`
          <th style="position:sticky">TOTAL PRESENT</th>
        
        `;
        while (i<=(count-2)) {
        document.getElementById("allforms").innerHTML+= `<tr style="display:flex" id="`+i+`"><td>`+i+`</td></tr>`;
        console.log(data)
        var j = 0;
        var s=0;
        while(j<=(cont-1)){
        document.getElementById(i).innerHTML+=`<td style="width:200px">`+data[j][i]+`</td>`;
        if(j>1){
        s = s+parseInt(data[j][i])
        
        }
        
        j +=1;
        }
        document.getElementById(i).innerHTML+=`<td style="width:200px">`+s+`</td>`;
        i += 1;
        
      }
        
        
        
        document.getElementById("loader").style.display = "none";
        

        
   // show(data);
}
// Calling that async function
getapi(api_link);

       

    
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
        <a href="logout.php"><li>LOGOUT</li></a>
      </ul>
    </nav>
   </div>
<center>  <a href="report.php" style="padding:6px;border-radius:10px;background-color:blue;text-decoration:none;">Check Another Class</a></center>
<br>


   <!--<footer style="text-align: center;background-color: #343a40;padding: 10px; bottom: 0;">© 2022 RGUKT-AP., Srikakulam Campus | Designed By: <a href="https://www.instagram.com/dileepadari/">Delhi</a> </footer>-->
 
 
</body>
<script src="https://unpkg.com/stein-expedite@0.1.0/dist/index.js"></script>

</html>