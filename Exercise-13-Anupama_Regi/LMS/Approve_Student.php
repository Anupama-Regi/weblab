<html>
    <head>
        <title>APPROVAL</title>
		<link rel="stylesheet" type="text/css" href="lms_1.css">
		<meta name="viewport" content="width:device-width;initial-scale:1.0;">

        <style>
			th,tr,td{
				line-height:20px;
				font-size:18px;
			}
			.view_book table{
				margin-left:1%;
			}
        </style>
    </head>
    <body><br><br><br>
	<?php
	include('A_Fields.php');
	?>
	<div class="view_book">
    <h1><b>APPROVAL</b></h1>

<?php

include "Connection.php";



    $sql="select * from student where Status='Pending'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result))
    {
      echo '<table border=1 width=99% cellpadding=10px ><tr><th>ADMISSION NUMBER</th><th>NAME</th><th>SEMESTER</th><th>DEPARTMENT</th><th>PHONE NO</th><th>APPROVE/REJECT</th></tr>';
      while($row=mysqli_fetch_array($result))
      {
        echo '<form  method="POST">';
        echo '<tr><td align="center">'.$row["Admission_No"].'</td><td>'.$row["Name"].'</td><td>'.$row["Semester"].'</td><td>';
		$dept=$row["Department"];
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
		echo $dept."</td><td>".$row['Phone_No']."</td><td>
        <input type=hidden name=admno value=".$row['Admission_No']."><input style='font-size:13px;' type=submit name=approve value=APPROVE>|<input type=submit name=reject value=REJECT></td></tr></form>";
    
      }

      echo '</table>';
     
    }
   
    else
    {
      echo '<p style=color:red;text-align:center;font-size:30px;><b>Table is Empty</b></p>';
	  header("refresh:1;url=Admin.php");
    }

    mysqli_close($conn);

?>


<?php
include "Connection.php";

/*if(array_key_exists('approve',$_POST))*/
if(isset($_POST['approve']))
{       
    $uname=$_POST["admno"];

	$sql1="update student set Status='Approved' where Admission_No=".$uname;
      
    if(mysqli_query($conn,$sql1))
    {
      echo '<script>alert("Approved");</script>';
	  header("refresh:1;url=Admin.php");
    }
}
/*elseif(array_key_exists('reject',$_POST))*/
if(isset($_POST['reject']))
{
    $uname=$_POST["admno"];
    $select_query ="update student set Status='Rejected' where Admission_No=".$uname;
    if(mysqli_query($conn,$select_query))
    {
      echo '<script>alert("Rejected");</script>';
	  header("refresh:1;url=Admin.php");
    }
}

mysqli_close($conn);

?>
</div>
</body>
</html>

