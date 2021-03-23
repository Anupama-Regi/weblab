<html>
<head>
<title>Login form</title>
<link rel="stylesheet" type="text/css" href="lms_1.css">
<meta name="viewport" content="width:device-width;initial-scale:1.0;">
<style>
#error{
	color:tomato;
	font-size:15px;
}
#loginEr{
	color:red;
	font-size:20px;
}
</style>
</head>
<body class="home"><br><br><br>
<?php include('H_Fields.php');
$uidEr = $pwdEr = $loginEr = "";
$uid = $pwd ="";
if(isset($_POST['submit']))
	{
		$u=$_POST["uid"];
		$p=$_POST["pwd"];
		//username
		if(empty($u)){
			$uidEr="Please Enter Your User Id";
		}/*else if(!preg_match("/^[0-9]+/",$u)){
			$uidEr="Please Enter A Valid User Id";
		}
		else if(!preg_match("/^[0-9]{5,10}$/",$u)){
			$uidEr="Please Enter A User Id With Atleast 5 and Atmost 10 Characters";
		}*/
		else{
			$uid=$u;
		}
		//password
		if(empty($p)){
			$pwdEr="Please Enter Your Password";
		}
		/*else if (!preg_match("/[A-Za-z]+/",$p)) {  
            $pwdEr = "Required Atleast One Alphabet";  
        }
		else if (!preg_match("/\d+/",$p)) {  
            $pwdEr = "Required Atleast One Digit";  
        }
		else if(strlen($p)<0 || strlen($p)>10){
			$pwdEr = "Enter a password with atleast 5 and atmost 10 characters";
		}*/
		else{
			$pwd=$p;
		}
		if($uid!="" && $pwd!="" && $uidEr=="" && $pwdEr==""){
			session_start();
			include("Connection.php");
			$F=$SF1=$SF2=0;
			$qr1=mysqli_query($conn,"select * from login where User_Id='$uid' and Password='$pwd' and Role='Admin'") or die("Error:".mysqli_error($conn));
			$qr2=mysqli_query($conn,"select * from login where User_Id='$uid' and Password='$pwd' and Role='Student' and User_Id IN(select Admission_No from Student where Status='Approved')") or die("Error:".mysqli_error($conn));
			$qr3=mysqli_query($conn,"select * from login where User_Id='$uid' and Password='$pwd' and Role='Student' and User_Id IN(select Admission_No from Student where Status!='Approved')") or die("Error:".mysqli_error($conn));
			if(mysqli_num_rows($qr1)>0)
			{
				$_SESSION['uid']=$uid;
				header("location:Admin.php");
				$F++;
				exit;
			}
			 if(mysqli_num_rows($qr2)>0)
			{
				$_SESSION['uid']=$uid;
				header("location:Student.php");
				$SF1++;
				exit;
			}
			if(mysqli_num_rows($qr3)>0)
			{
				$SF2++;
			}
			if($F==0 && $SF1==0 && $SF2==0){
				$loginEr = "Invalid Username Or Password";
				header("refresh:3;url=Home.php");
			}
			if($SF2==1){
				$loginEr = "Not Yet Approved";
				header("refresh:3;url=Home.php");
			}
			mysqli_close($conn);
		}
	}
?>
<div class="login">
<img src="user.png">
<h1>Login Now</h1>
<form method ="POST">
<input type="text" name="uid" placeholder="Your User Id" value="<?php echo $uid;?>">
<span id="error"><small><?php echo $uidEr;?></small></span>
<input type="password" name="pwd" placeholder="Your Password" value="<?php echo $pwd;?>">
<span id="error"><small><?php echo $pwdEr;?></small></span><br><br>
<input type="submit" name="submit" value="Sign In"><br>
<a href="#">Lost Your password ? </a><br><br><a href="Student_Registration.php">Don't Have An Account ? </a><br>
<span id="loginEr"><small><?php echo $loginEr;?></small></span>
</form>
</div>
</body>
</html>