<html>
<head>
<title>Issue A Book</title>
<link rel="stylesheet" type="text/css" href="lms_1.css">
<meta name="viewport" content="width:device-width;initial-scale:1.0;">
<style>
#error{
	color:red;
	font-size:15px;
}
</style>
</head>
<body><br><br><br>
<?php
include("Connection.php");
$qry=mysqli_query($conn,"SELECT * FROM Book_Issue") or die("Error:".mysqli_error($conn));
$qr1=mysqli_query($conn," SELECT * FROM Book where Quantity > 0") or die("Error:".mysqli_error($conn));
$qr2=mysqli_query($conn," SELECT * FROM Student where Status='Approved'") or die("Error:".mysqli_error($conn));
$nr=mysqli_num_rows($qry);
if($nr>0)
{
	$nr++;	
}
else
{ 
	$nr=1;
}
$book=array();
$student=array();
$n=0;
while($row=mysqli_fetch_array($qr1))
{
	$book[$n]=$row['Book_Id'];
	$n++;
}
$n=0;
while($row=mysqli_fetch_array($qr2))
{
	$student[$n]=$row['Admission_No'];
	$n++;
}
include('A_Fields.php');
$bidEr = $sidEr = "";
$bid = $sid = $check1 = $check2 = "";
if(isset($_POST['submit']))
	{
		$b=$_POST["bid"];
		$s=$_POST["sid"];
		$isid=$_POST["isid"];
		$is_date=date('y-m-d');
		$due_date=date('y-m-d',strtotime($is_date.'+14 days'));
		//bookid
		if(empty($b) || $b=='none'){
			$bidEr="Please Select The Book";
		}
		else{
			$bid=$b;
			$check1='selected';
		}
		//studentid
		if(empty($s) || $s=='none'){
			$sidEr="Please Select The Student";
		}
		else{
			$sid=$s;
			$check2='selected';
		}
		if($bid!="" && $sid!="" && $sidEr=="" && $bidEr==""){
			$qnty=mysqli_query($conn,"select Quantity from Book Where Book_Id = '$bid'") or die("Error..:".mysqli_error($conn));
			while($row=mysqli_fetch_array($qnty))
			{
			 $qu = $row['Quantity'];
			}
			$qu--;
			$q=mysqli_query($conn,"update Book set Quantity='$qu' where Book_Id='$bid'");
			$qr=mysqli_query($conn,"INSERT INTO Book_Issue(Issue_id,BookId,Student_Id,Issue_Date,Due_Date,Status)VALUES('$isid','$bid','$sid','$is_date','$due_date','Issued')");
			if($qr)
			{
				echo "<script>alert('Book Issued Successfully');</script><br>";
				header("refresh:2;url=Admin.php");
			}
			else
			{
				echo"Try Again:<hr>".mysqli_error($conn);
				header("refresh:2;url=Admin.php");
			}
			mysqli_close($conn);
		}
	}
?>

<div class="book_issue">
<h1><big>I</big>SSUE <big>A B</big>OOK <big>H</big>ere....</h1>
<form name="frm" method="post">
<table width="80%" border="0" cellpadding="10px">

<tr><th>ISSUE_ID </th><td colspan="100%"><input type="text" name="isid" value=IS<?php echo $nr;?> readonly></td></tr>
<tr><th>BOOK_ID </th><td colspan="100%"><select name="bid" >
<option value="none">-----------Select-------------</option>
<?php
foreach($book as $b)
{
	echo "<option ";if($bid==$b) echo $check1; echo ">". $b."</option>";
}
?>
</select><br><span id="error"><small><?php echo $bidEr;?></small></span></td></tr>
<tr><th>STUDENT_ID </th><td colspan="100%"><select name="sid" >
<option value="none">-----------Select-------------</option>
<?php
foreach($student as $s)
{
	echo "<option ";if($sid==$s) echo $check2; echo ">". $s."</option>";
}
?>
</select><br><span id="error"><small><?php echo $sidEr;?></small></span></td></tr>


<tr height="50px"><td colspan="100%"><input type="reset" name="reset" value="CLEAR"><input type="submit" name="submit" value="SUBMIT"></td></tr>
</table></form><br>
</div></body>
</html>
<!--$d=date('Y/m/d H:i:s');
$d=date('Y/m/d');-->