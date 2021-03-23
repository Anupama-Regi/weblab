<?php
include('Connection.php');
$qry="select * from Book where Book_Id like 'B%' ";
$title="";
if(isset($_POST['search']))
{
$title=$_POST['title'];
if(strlen($title)!=0)$qry=$qry." and Title like '%".$title."%'";
}
?>
<html>
<head>
<style>
td
{
	text-align:center;
}
</style>
<link rel="stylesheet" type="text/css" href="lms_1.css">
<meta name="viewport" content="width:device-width;initial-scale:1.0;">
</head>
<body><br><br><br>
<?php
include('S_Fields.php');
?>
<div class="view_book">
<form method=post>
<input type=text name="title" placeholder="Enter book name...">&nbsp;&nbsp;&nbsp;
<input type=submit name="search" value="SEARCH">
</form>
<?php
	//$qr="select * from book where title=$title";
	$qr=mysqli_query($conn,"$qry") or die("Error:".mysqli_error($conn));
	if(mysqli_num_rows($qr))
	{
		echo "<table border=1 align=center width=90% height=20%>
		<tr><th>BOOK_ID</th>
		<th>TITLE</th>
		<th>AUTHOR</th>
		<th>PUBLISHER</th>
		<th>EDITION</th>
		<th>COST</th>
		<th>QUANTITY</th></tr>";
		while($row=mysqli_fetch_array($qr))
		{	
			echo "<tr><td>".$row['Book_Id']."</td>
			<td>".$row['Title']."</td>
			<td>".$row['Author']."</td>
			<td>".$row['Publisher']."</td>
			<td>".$row['Edition']."</td>
			<td>".$row['Cost']."</td>
			<td>".$row['Quantity']."</td></tr>";
		}
	}
	else
	{
		echo "!!!No such books.";//.$qr.mysqli_error($conn);
	}

?>
</div>
</body>
</html>
