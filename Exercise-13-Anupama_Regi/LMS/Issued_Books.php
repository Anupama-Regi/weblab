<html>
<head>
<title>Issued Books</title>
<link rel="stylesheet" type="text/css" href="lms_1.css">
<meta name="viewport" content="width:device-width;initial-scale:1.0;">
<style>
.i{
	background-color:lightgreen;
}
</style>
</head>
<body><br><br>
<?php
include('Connection.php');
include('A_Fields.php');
$qry="select Issue_Id,BookId,Student_Id,Due_Date,Status from Book_Issue where BookId like 'B%' ";
$id="";
if(isset($_POST['search']))
{
$id=$_POST['id'];
if(strlen($id)!=0)$qry=$qry." and BookId like '%".$id."%'";
}
?><div class="issued">
<h1><big>I</big>SSUED <big>B</big>OOKS....</h1>
<br>
<form method="post">
<table style="margin-left:auto;margin-right:auto;"border="0" width="50%" ><th><input type="text" placeholder="Enter Book Id" name="id"/></th>
 <th><input type="submit" name="search" value="SEARCH"/></button></th>
</table>
</form>
<?php
$qry=$qry."ORDER BY Status";
$qry=mysqli_query($conn,"$qry") or die("Error:".mysqli_error($conn));
if(mysqli_num_rows($qry))
{
	echo '<table border="1" align="center" width="90%">
	<tr>
	<th>Book id</th>
	<th>Student Id</th>
	<th>Due Date</th>
	<th>Status</th>
	</tr>';
	while($row=mysqli_fetch_assoc($qry))

      { if($row["Status"]=='Returned')
		$class='r';else $class='i';
		echo '<tr class='.$class.' ><td>'.$row["BookId"].'</td>
        <td>'.$row["Student_Id"].'</td>
        <td>'.$row["Due_Date"].'</td>';
		if($row["Status"]=='Returned')
        echo '<td> <font color=blue>Returned</font>';
		else if($row["Status"]=='Issued')
		echo '<td><form method=POST>
		<input type=hidden name=isid value='.$row["Issue_Id"].'>
		<input type=hidden name=bid value='.$row["BookId"].'>
		<input type=submit name=quantity value=RETURN>
		</form>
		</td>
		</tr>';
       }
	echo '</table><br>';
}
else
{
 echo '<script>alert("No such Book Is Found");</script>';
 header("refresh:.1;url=Issued_Books.php");
}
if(isset($_POST['quantity'])){
	$qnty=mysqli_query($conn,"select Quantity from Book Where Book_Id = '".$_POST['bid']."'") or die("Error..:".mysqli_error($conn));
	while($row=mysqli_fetch_array($qnty))
		{
		 $qu = $row['Quantity'];
		}
		$qu++;
		$q=mysqli_query($conn,"update Book set Quantity='$qu' where Book_Id='".$_POST['bid']."'") or die("Error..:".mysqli_error($conn));
		$s=mysqli_query($conn,"update Book_Issue set Status='Returned' where Issue_Id='".$_POST['isid']."'") or die("Error..:".mysqli_error($conn));
		if($s){
			header("location:Issued_Books.php");
	}
}
?>
</div>
</body>
</html>



