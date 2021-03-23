<html>
<head>
<link rel="stylesheet" type="text/css" href="lms_1.css">
<meta name="viewport" content="width:device-width;initial-scale:1.0;">
</head>
<body><br><br><br>
<?php
	include("Connection.php");
	include('S_Fields.php');
	session_start();
	$s=$_SESSION['uid'];
?>
<div class="accnt">
<h1 align="center" style="padding:5% 5% 0% 5%;"><b><big>Y</big>OUR <big>A</big>CCOUNT</b></h1>
<table border=1 width="70%" cellpadding='10px'>
<?php
$sql="SELECT * FROM Student where Admission_No='$s'";
$qr=mysqli_query($conn,"$sql") or die("Error:".mysqli_error($conn));
while($row=mysqli_fetch_array($qr))
{
		echo "<tr><th align=left>ADMISSION NO</th><td>".$row['Admission_No']."</td></tr>
	    <tr><th align=left>NAME</th></th><td>".$row['Name']."</td></tr>
	    <tr><th align=left>SEMESTER</th><td>".$row['Semester']."</td></tr>
		<tr><th align=left>DEPARTMENT</th></th><td>";
		$dept=$row['Department'];
		switch($dept){
			case "MCA"		 :	$dept="Computer Applications";
								break;
			case "Civil"	 :  $dept="Civil Engineering";
								break;
			case "Electrical":  $dept="Electrical Engineering";
								break;
			case "Mech" 	 :	$dept="Mechanical Engineering";
								break;
			case "EC"		 : 	$dept="Electronics and Communication Engineering";
								break;
			case "CS"		 :	$dept="Computer Science and Engineering";
								break;
			case "Arch"		 :  $dept="Architecture";
								break;
			case "SOM"  	 :  $dept="School of Management";
								break;
			case "Maths" 	 :  $dept="Mathematics";
								break;
			case "Phy"		 :  $dept="Physics";
								break;
			case "Chem"		 :	$dept="Chemistry";
								break;
			case "PhyEdu"	 :	$dept="Physical Education";
								break;
		}
		echo $dept."</td></tr>
		<tr><th align=left>PHONE NO</th></th><td>".$row['Phone_No']."</td></tr>";
}
$qr=mysqli_query($conn,"SELECT Password FROM Login where User_Id='$s'") or die("Error:".mysqli_error($conn));
while($row=mysqli_fetch_array($qr)){
echo "<tr><th align=left>PASSWORD</th><td>".$row['Password']."</td></tr>";	
}
mysqli_close($conn);
?>
</table>
</div>
</body>
</html>