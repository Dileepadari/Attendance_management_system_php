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
    <title>Individual-Report</title>
    
<script>
    

    var api_url;
    function search(){
    
      if(window.navigator.onLine==false){
        window.alert("Please connect to internet!");
      }
    var col_id = document.getElementById("college_id").value;
     const sub_table = ["telugu","english","mathematics","physics","chemistry","information technology"];
     var total_p = 0;
     var total_a = 0;
     sub_table.forEach(sub => {
        api_url = "<?php echo $_SESSION['api_search_key'] ?>" +"/"+sub;
    
        async function getapi(url) {
    
    // Storing response
    const response = await fetch(url);
    
    // Storing data in form of JSON
    data = await response.json();
    var count = Object.keys(data[0]).length;
    var cont = Object.keys(data).length;
   
    var i = 1;
        while (i<=(count-2)) {
            if(data[0][i]==col_id){
             roll = i;
            }
            i+=1
        }
    var j = 2;
    var present = 0;
    var absd = [];
 
    while (j<=(cont-1)) {
        present = present + Number(data[j][roll]);
        if(data[j][roll]==0){
           absd.push(data[j]["S. No"])
           
           }
         
          
           
        j+=1;
    }
    if (absd.length===0) {
            absd = "Not Absent";
           }
       document.getElementById("stu_name").innerHTML=data[1][roll];
      document.getElementById(sub+"p").innerHTML = present;
      document.getElementById(sub+"a").innerHTML = cont-(present+2);
      document.getElementById(sub+"d").innerHTML = absd;
      total_p = total_p+present;
      total_a = total_a+(cont-(present+2));
      document.getElementById("total_pre").innerHTML=total_p;
     document.getElementById("total_abs").innerHTML=total_a;
      
 }          
        getapi(api_url);
 
     });
     document.getElementById("stu_id").innerHTML=col_id;
     
     document.getElementById("stu_class").innerHTML= <?php echo"$course+' '+$section";?>
     return;
    
    
    }
 
    
    </script>
    <style>
        *{
            
            margin: 0;
            padding: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            
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
   td{
    text-align: center;
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
             z-index: 1; 
             margin-right: 40px;
         }

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

       
       <center style="border: solid 1px; margin-top: 60px;" id="start">
    
        <p>Please Reload the page before searching for New Student Attendance Report</p>
         <br>
    Teacher:<?php print_r($user_data['name']) ?>
    <br>
        <br>
        <form method="POST" action="searchwork.php">
      <!--  <label for="SUBJECT">SUBJECT:</label>
        <select class="subject" name="SUBJECT" id="subject" required>
          <option value="telugu">TELUGU</option>
          <option value="english">ENGLISH</option>
            <option value="mathematics">MATHEMATICS</option>
            <option value="physics">PHYSICS</option>
            <option value="chemistry">CHEMISTRY</option>
            <option value="information technology">IT</option>
            <option value="biology">BIOLOGY</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    -->
        <label for="CLASS">COURSE:</label>
        <select class="cla" name="class" id="class" required>
            <option value="puc-1">PUC-1</option>
            <option value="puc-2">PUC-2</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="SEM">SEMESTER:</label>
        <select class="sem" name="sem" id="sem" required>
            <option value="sem-1">SEM-1</option>
            <option value="sem-2">SEM-2</option>
        </select>
        
        <br><br>
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
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="id_no">Enter ID.No:</label>
        <input type="text" placeholder="EG:RS200302" id="college_id" name="id_no" required>
        <br><br>
        <input type="submit" value="Search"  name="sub_btn">
</form>
        <br><br>
        </center>
        <br><br>
        <center>
        <table border="1px solid">
            <caption>INDIVIDUAL-REPORT</caption>
            <tr>
                <th>ID.NO:</th>
                <th>CLASS:</th>
                <th colspan="2">NAME:</th>
            </tr>
            <tr>
                <td id="stu_id">RS</td>
                <td id="stu_class"></td>
                <td colspan="2" id="stu_name"></td>
            </tr>
            <tr>
                <th>SUBJECT</th>
                <th>No.of Present Days</th>
                <th>No.of Absent Days</th>
                <th>Absent Days</th>
            </tr>
            <tr>
                <td>TELUGU</td>
                <td id="telugup"></td>
                <td id="telugua"></td>
                <td id="telugud">-</td>
            </tr>
            <tr>
                <td>ENGLISH</td>
                <td id="englishp"></td>
                <td id="englisha"></td>
                <td id="englishd">-</td>
            </tr>
            <tr>
                <td>MATHEMATICS</td>
                <td id="mathematicsp"></td>
                <td id="mathematicsa"> </td>
                <td id="mathematicsd">-</td>
            </tr>
            <tr>
                <td>PHYSICS</td>
                <td id="physicsp"></td>
                <td id="physicsa"></td>
                <td id="physicsd">-</td>
            </tr>
            <tr>
                <td>CHEMISTRY</td>
                <td id="chemistryp"></td>
                <td id="chemistrya"></td>
                <td id="chemistryd">-</td>
            </tr>
            <tr>
                <td>IT</td>
                <td id="information technologyp"></td>
                <td id="information technologya"></td>
                <td id="information technologyd">-</td>
            </tr>
            <tr>
                <th>TOTAL</th>
                <th id="total_pre"></th>
                <th id="total_abs"></th>
                <th>-</th>
            </tr>

        </table>
        </center>
        
       <!--<footer style="text-align: center;background-color: #343a40;padding: 10px 0;position: absolute;width: 100%; bottom: 0;">© 2022 RGUKT-AP., Srikakulam Campus | Designed By: <a href="https://www.instagram.com/dileepadari/">Delhi</a> </footer>-->
</body>
<?php
if(isset($_POST['sub_btn'])){
  $course = $_POST['class'];
  $sem = $_POST['sem'];
  $section = $_POST['section'];
  $conn = mysqli_connect("localhost","id19436597_sklm_att","@I&7ANIviF0PHW\|","id19436597_rgukt_att_sys_db");
  $query = "select * from links where course = '$course' and sem = '$sem' and section='$section' limit 1 ";
  print_r($query);
  $result = mysqli_query($conn,$query);
 if(mysqli_num_rows($result)!=0)
  {
 
    $user_data = mysqli_fetch_assoc($result);
    $link = $user_data['api_link'];
    $_SESSION['api_search_key'] = $link;
    echo "<script>search();</script>";
  
 }
 else{
     echo "<script>alert('NO Records Found')</script>";
 }
 
 }
?>

</html>