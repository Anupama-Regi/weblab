<html>
<head>
	<title>Exercise-22</title>
<style>
table
{
color:black;
width:90%;
height:70%;
}
td
{
font-style:italic;
color:black;
font-weight:bold;
}
body
{
background-color:lightgray;
}
th
{
font-size:25;
color:red;
text-decoration:underline;
}
tr,td
{
padding:1em;
color:black;
text-align:center;
}
marquee
{
color:blue;
}
</style>
</head>
<body align=center>
	<marquee onmouseover=this.stop() onmouseout=this.start()><h1>Data_Display</h1></marquee> 
	<h3 style="vertical-align:top;text-align:center;font-weight:bold;font-style:normal;text-decoration:underline;color:black;">DETAILS</h3>
	<a href="Exercise-12-1_insert.php" style="text-align:right;width:20%;color:red;font-size:125%;">BACK</a>
</body>
</html>


<?php
include ("connection.php");
$query="select * from exercise12";
$values=mysqli_query($conn,$query);
echo '<table align=center border="2"><th>Name</th><th>Gender</th><th>Password</th><th>Email</th><th>Phone Number</th>';
if(mysqli_num_rows($values))
{

	while($row=mysqli_fetch_assoc($values))
	{
		echo '<tr>';
		echo '<td>';
		echo $row["name"];
		echo '</td>';
		echo '<td>';
		echo $row["gender"];
		echo '</td>';
		echo '<td>';
		echo $row["pass"];
		echo '</td>';
		echo '<td>';
		echo $row["email"];
		echo '</td>';
		echo '<td>';
		echo $row["phno"];
		echo '</td>';
		echo '</tr>';
	}
}
else
{
	echo "Error : ".$query.mysqli_error($conn);
}
?>