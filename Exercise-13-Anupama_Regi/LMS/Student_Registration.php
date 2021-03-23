<?php
$admno=$name=$sem=$dept=$phone=$password="";
$admnoEr=$nameEr=$semEr=$deptEr=$phoneEr=$pwdEr=$check1=$check2="";
if(isset($_POST["register"]))
{
    include "connection.php";
    $a=$_POST["admno"];
    $n=$_POST["name"];
    $s=$_POST["sem"];
    $d=$_POST["dept"];
    $p=$_POST["phone"];
    $pwd=$_POST["passwd"];
    $status="Pending";
	$role="Student";
     //admission no
    if($a=="")
     {
        $admnoEr="Please enter your admission number.";                      
     } 
    elseif(strlen($a)>11)
    {
        $admnoEr="Allowed maxlength=11."; 
    }
    elseif(!preg_match ("/^[0-9]*$/", $a))
    {
        $admnoEr="Invalid admission number. Only numeric value is allowed."; 
    }
	else{
		$admno=$a;
	}
	//name
    if($n=="")
    {
        $nameEr="Please enter your name.";  
                     
    }
    elseif(strlen($n)>50)
    {
         $nameEr="Allowed maxlength=50."; 
    }
    elseif(!preg_match("/^[a-zA-z-\s]*$/",$n))
    {
         $nameEr="Only Alphabets and Spaces are allowed as name."; 
    }
    else{
		$name=$n;
	}
	//sem
    if($s=="")
    {
        $semEr="Please select your semester.";  
                     
    }
    else{
		$sem=$s;
		$check1="selected";
	}
	//dept
    if($d=="")
    {
        $deptEr="Please select your department.";  
                     
    }
    else{
		$dept=$d;
		$check2="selected";
	}
    //phone number
    if(!preg_match ("/^[0-9]*$/", $p))
    {
         $phoneEr="Only numeric value is allowed as phone number."; 
    }
    elseif(strlen($p)!=10 || $p=="")
    {
        $phoneEr="Enter 10 digit number.";
    }
	else{
		$phone=$p;
	}
	//password
	if(empty($pwd)){
			$pwdEr="Please Enter Your Password";
		}
		else if (!preg_match("/[A-Za-z]+/",$pwd)) {  
            $pwdEr = "Required Atleast One Alphabet";  
        }
		else if (!preg_match("/\d+/",$pwd)) {  
            $pwdEr = "Required Atleast One Digit";  
        }
		else if (strlen($pwd)<5) {  
            $pwdEr = "Required Atleast 6 Characters";  
        }
		else if (strlen($pwd)>10) {  
            $pwdEr = "Atmost 10 Characters";  
        }
		else{
			$password=$pwd;
		}
    if($admno!="" && $name!="" && $sem!="" && $dept!="" && $phone!="" && $password!=""){
		$sql="insert into student values($admno,'$name','$sem','$dept',$phone,'$status')";
		$qry=mysqli_query($conn,"INSERT INTO login(User_Id,Password,Role)VALUES('$admno','$password','$role')") or die("Error:".mysqli_error($conn));
		if(mysqli_query($conn,$sql))
		{
			if($qry){
				echo '<script>alert("Registration successfully");</script>';
				header("refresh:1;url=Login.php");
			}
		}
		else
		{
			echo  '<script>alert("Registration unsuccessfully.Try again");</script>';
		}
		mysqli_close($conn);
	}
}
?>
<html>
    <head>
        <title>REGISTRATION</title>
		<link rel="stylesheet" type="text/css" href="lms_1.css">
		<meta name="viewport" content="width:device-width;initial-scale:1.0;">
		<style>
			#error{
				font-size:small;
				color:tomato;
			}
		</style>
    </head>
    <body class="home"><br><br>
	<?php
	include('H_Fields.php');
	?>
	<div class="reg">
    <form method="POST" name="myform">
    <h1 align="center" style="padding:5% 5% 0% 5%;"><b>REGISTRATION</b></h1>

	<table width="75%" border="0" style="border-collapse: collapse;">
        <th colspan="2" rowspan="2"><h2 style="color:teal;margin-left:20%;">Not yet a member ?</h2></th>
        <tr></tr>
       
        <tr>
            <th>
                Admission No
            </th>
            <td>
                <input type="text" name="admno" placeholder="Enter admno..." value="<?php echo $admno;?>"/>
				<br><span id="error"><small><?php echo $admnoEr;?></small></span>
            </td>
        </tr>
        <tr>
            <th>
                Name
            </th>
            <td>
                <input type="text" name="name" placeholder="Enter name..." value="<?php echo $name;?>"/>
				<br><span id="error"><small><?php echo $nameEr;?></small></span>
            </td>
        </tr>
        <tr>
            <th>
                Semester
            </th>
            <td>
                <select id="select" class="id" name="sem" required>
                    <option value="">-----------SELECT-----------</option>
                    <?php
                        for($i=1;$i<9;$i++)
                        {
							echo "<option ";if($sem==$i) echo $check1; echo ">".$i."</option>";
                        }
                    ?>
                    
                </select><br><span id="error"><small><?php echo $semEr;?></small></span>
            </td>
        </tr>
        <tr>
            <th>
                Department
            </th>
            <td>
                <select id="select" class="id" name="dept" required>
                    <option value="">-----------SELECT-----------</option>
                    <option value="MCA" <?php if($dept=="MCA") echo $check2;?>>Computer Applications</option>
                    <option value="Civil" <?php if($dept=="Civil") echo $check2;?>>Civil Engineering</option>
                    <option value="Electrical" <?php if($dept=="Electrical") echo $check2;?>>Electrical Engineering</option>
                    <option value="Mech"  <?php if($dept=="Mech") echo $check2;?>>Mechanical Engineering</option>
                    <option value="EC" <?php if($dept=="EC") echo $check2;?>>Electronics and Communication Engineering</option>
                    <option value="CS" <?php if($dept=="CS") echo $check2;?>>Computer Science and Engineering</option>
                    <option value="Arch" <?php if($dept=="Arch") echo $check2;?>>Architecture</option>
                    <option value="SOM" <?php if($dept=="SOM") echo $check2;?>>School of Management</option>
                    <option value="Maths" <?php if($dept=="Maths") echo $check2;?>>Mathematics</option>
                    <option value="Phy" <?php if($dept=="Phy") echo $check2;?>>Physics</option>
                    <option value="Chem" <?php if($dept=="Chem") echo $check2;?>>Chemistry</option>
                    <option value="PhyEdu"  <?php if($dept=="PhyEdu") echo $check2;?>>Physical Education</option>
                </select>
				<br><span id="error"><small><?php echo $deptEr;?></small></span>
            </td>
        </tr>      
           
    
        
        <tr>
            <th>
                Phone No
            </th>
            <td>
                <input type="text" name="phone" placeholder="Enter phone no..." value="<?php echo $phone;?>"/>
                <br><span id="error"><small><?php echo $phoneEr;?></small></span>

            </td>
            
        </tr>
        <tr>
            <th>
                Password
            </th>
            <td>
                <input type="password" name="passwd" placeholder="Enter password..." value="<?php echo $password;?>" />
				<br><span id="error"><small><?php echo $pwdEr;?></small></span>
            </td>
        </tr>
       
        <tr>
            <td>
                <input  style="float:right;" type="reset" value="CLEAR"/>
            </td>
            <td>
                <input  style="float:left;" type="submit" name="register" value="REGISTER"/>
            </td>
        </tr>
    </table>
    </form>
	</div>
    </body>
</html>
