<html>
<head>
<title>Exercise-12</title>
<style>
table
{
color:red;
background-color:lightgray;
width:60%;
height:90%;
border-collapse:collapse;
}
input[type=text],input[type=password],input[type=email]
{
width:50%;
}
input[type="submit"],input[type="reset"]
{
color:white;
background-color:gray;
font-weight:bold;
cursor:pointer;
}
td
{
font-style:italic;
font-weight:bold;
}
body
{
background-color:gray;
}
marquee
{
color:yellow;
}
</style>
</head>


<?php
include("connection.php");
$n1=$pwd=$e=$ph=$gender="";
$radio="";
if(isset($_POST["submit"]))
{
$n=$_POST["name"];
$g=$_POST["gender"];
$p=$_POST["pass"];
$em=$_POST["email"];
$m=$_POST["phno"];


if($n=="")
{
echo '<script>alert("Please enter your name.");</script>';
}
else if(!preg_match("/^[a-zA-Z-\s]*$/",$n))
{
echo '<script>alert("Please enter a valid name.");</script>';
}
else
{ $n1=$n;}

if($g=="none")
{
echo '<script>alert("Please enter your gender.");</script>';
}
else
{
	$gender=$g;
	$radio="checked";
}

if($p=="")
{
echo '<script>alert("Please enter a password.");</script>';
}
else if(strlen($p)<=8)
{
echo '<script>alert("Please enter a password with 8 character");</script>';
}
else{$pwd=$p;}

if($em=="")
{
echo '<script>alert("Please enter your email.");</script>';
}
else if(!strpos($em,"@") || !strpos($em,".com"))
{
echo '<script>alert("Please enter valid email.");</script>';
}
else{$e=$em;}

if($m=="")
{
echo '<script>alert("Please enter your phone number.");</script>';
}
else if(strlen($m)!=10)
{
echo '<script>alert("Please enter valid phone number.");</script>';
}
else{$ph=$m;}

if($n1!="" && $gender!="" && $pwd!="" && $e!="" &&$ph!=""){
echo '<script>alert("Successful...");</script>';
$sql="insert into exercise12 values('$n1','$gender','$pwd','$e','$ph')";
if(mysqli_query($conn,$sql))
	{
  	echo '<script>alert("Registration Successful...");</script>';
    		header("refresh:2;url=Exercise-12-2_display.php");
   	}
	else
	{
		echo '<script>alert("Registration Unsuccessful...");</script>';
 		echo"Registration Unsuccessful:<hr>".mysqli_error($conn);
 		header("refresh:2;url=Exercise-12-1_insert.php");
	}
mysqli_close($conn);}
}

?>


<body align=center>
<marquee onmouseover=this.stop() onmouseout=this.start()><h1>Data_Insertion</h1></marquee> 
<a href="Exercise-12-2_display.php" style="text-align:right;width:20%;color:red;font-size:125%;">NEXT</a>
<form method="post" action="Exercise-12-1_insert.php" name="form1">
<table align="center" border="1">
<tr><td colspan="2" style="vertical-align:top;text-align:center;font-weight:bold;font-style:normal;text-decoration:underline;">REGISTRATION FORM</td>
</tr>
<tr align="left"><th>Name</th><td><input type=text name="name" placeholder=" Your name..." value="<?php echo $n1;?>"></td></tr>
<tr align="left"><th>Gender</th><td>
<input type="radio" name="gender" value="none" style="display:none;" checked> 
<input type="radio" name="gender" value="Male" <?php if($gender=='Male') echo $radio;?>>Male
<input type="radio" name="gender" value="Female" <?php if($gender=='Female') echo $radio;?>>Female
<input type="radio" name="gender" value="Others" <?php if($gender=='Others') echo $radio;?>>Others
</td></tr>
<tr align="left"><th>Password</th><td><input type=password name="pass" placeholder=" Your password..." value="<?php echo $pwd;?>"><font color=red> (*must contain atleast 8 character)</font></td></tr>
<tr align="left"><th>Email.id</th><td><input type="text" name="email"  placeholder=" Your mail-id..." value="<?php echo $e;?>"></td></tr>
<tr align="left"><th>Phone Number</th><td><input type="number" name="phno"  placeholder=" Your Phone number..." value="<?php echo $ph;?>"></td></tr>
<tr><td colspan="2" style="vertical-align:top;text-align:center;">
<input type="reset" value="RESET">
<input type="submit" name="submit" value="SUBMIT"></td></tr>
</table>
</form>
</body>
</html>