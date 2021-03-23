<html>
<head>
<style>
td
{
	text-align:center;
}
.view_book table{
	margin-left:20%;
}
</style>
<link rel="stylesheet" type="text/css" href="lms_1.css">
<meta name="viewport" content="width:device-width;initial-scale:1.0;">
</head>
<body><br><br><br>
<?php
	include('A_Fields.php');
?>
<div class="view_book">
<h1><big>M</big>EMBERS....</h1>
<?php
include ("Connection.php");
$query="select * from student where Status='Approved'";
$values=mysqli_query($conn,$query);

if(mysqli_num_rows($values))
{
	echo "<table align=center border=1  width=80% height=20%>
		<th>Admission Number</th>
		<th>Name</th>
		<th>Semester</th>
		<th>Department</th>
		<th>Phone Number</th></tr>";
	while($row=mysqli_fetch_assoc($values))
	{
		echo "<tr><td>".$row['Admission_No']."</td>
		<td>".$row['Name']."</td>
		<td>".$row['Semester']."</td>
		<td>";
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
		echo $dept."</td>
		<td>".$row['Phone_No']."</td>
		</tr>";

	}
}
else
{
	echo "Error : ".$query.mysqli_error($conn);
}
?></div></body>
</html>