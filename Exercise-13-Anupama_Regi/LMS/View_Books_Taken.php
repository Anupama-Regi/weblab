<html>
<head>
<link rel="stylesheet" type="text/css" href="lms_1.css">
<meta name="viewport" content="width:device-width;initial-scale:1.0;">
<style>
.i{
background-color:pink;
}
.view_book{
	width:70%;background-color:white;color:black;padding:20px 30px;
	margin: 8% auto;margin-top:90px;margin-bottom:20px;text-align: center;
	border-radius: 20px;box-sizing:border-box;opacity:.9;box-shadow:2px 2px 20px black;
}
</style>
</head>
<body><br><br><br>
<?php  
include('S_Fields.php');
?>
<div class="view_book">
<h1><b><big>B</big>OOKS <big>T</big>AKEN</b></h1>
  <?php
  include("connection.php");
  session_start();
  $s=$_SESSION['uid'];
  $res = mysqli_query($conn,"SELECT * FROM Book,Book_Issue WHERE Book.Book_Id=Book_Issue.BookId AND Book_Issue.Student_Id='$s' ORDER BY Book_Issue.Status");
	echo "<table border='1' cellpadding='10px' width='90%'> 
	<tr>
	<th>BOOK ID</th>
	<th>TITLE</th>
	<th>ISSUE DATE</th>
	<th>DUE DATE</th>
	<th>STATUS</th>
	</tr>";

  while($row=mysqli_fetch_array($res))
  {
  if($row['Status']=='Issued')
  $class='i';else $class='r';
  echo "<tr class=".$class.">";
  echo "<td>" . $row['Book_Id'] . "</td>";
  echo "<td>" . $row['Title'] . "</td>";
  echo "<td>" . $row['Issue_Date'] . "</td>";
  echo "<td>" . $row['Due_Date']  . "</td>";
  echo "<td>" . $row['Status'] . "</td>";
  echo "</tr>";
  }
  echo "</table>";

  mysqli_close($conn);
  ?>	
  </div>
</body>
</html>