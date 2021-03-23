<html>
<head>
<link rel="stylesheet" type="text/css" href="lms_1.css">
<meta name="viewport" content="width:device-width;initial-scale:1.0;">
<style>
#error{
	color:tomato;
	font-size:small;
}
</style>
</head>
<?php 
include "Connection.php";
$qr=mysqli_query($conn,"select * from book") or die("Error !! ".mysqli_error($conn));
$i=mysqli_num_rows($qr);
if($i>0){
	$i++;
}
else{
	$i=1;
}
$TitleEr=$AuthorEr=$PublisherEr=$EditionEr=$CostEr=$QuantityEr="";

$Title1=$Author1=$Publisher1=$Edition1=$Cost1=$Quantity1="";
if(isset($_POST["add"]))
{
    $Book_Id = $_POST["Book_Id"];
    $Title = $_POST["Title"];
    $Author = $_POST["Author"];
    $Publisher = $_POST["Publisher"];
    $Edition = $_POST["Edition"];
    $Cost = $_POST["Cost"];
    $Quantity = $_POST["Quantity"];
if(empty($Title)){
			$TitleEr="Please Enter Title";
		}
		else if (!preg_match("/^[A-Za-z ]{2,20}$/",$Title)) {  
            $TitleEr = "Please Enter A Valid title";  
        }
		else{
			$Title1=$Title;
		}
if(empty($Author)){
			$AuthorEr="Please Enter Author";
		}
		else if (!preg_match("/^[A-Za-z ]{2,20}$/",$Author)) {  
            $AuthorEr = "Please Enter A Valid Author";  
        }
		else{
			$Author1=$Author;
		}

if(empty($Publisher)){
			$PublisherEr="Please Enter Publisher";
		}
		else if (!preg_match("/^[A-Za-z ]{2,20}$/",$Publisher)) {  
            $PublisherEr = "Please Enter A Valid Publisher";  
        }
		else{
			$Publisher1=$Publisher;
		}

if(empty($Edition)){
			$EditionEr="Please Enter Edition";
		}
		else if (!preg_match("/^[0-9]$/",$Edition)) {  
            $EditionEr = "Please Enter A Valid Edition";  
        }
		else{
			$Edition1=$Edition;
		}
if(empty($Cost)){
			$CostEr="Please Enter Cost";
		}
		else if (!preg_match("/^[0-9]*$/",$Cost)) {  
            $CostEr = "Please Enter A Valid Cost";  
        }
		else if($Cost<0){
			$CostEr = "Please enter Cost greater than 0";
		}
		else{
			$Cost1=$Cost;
		}


if(empty($Quantity)){
			$QuantityEr="Please Enter Quantity";
		}
		else if (!preg_match("/^[0-9]+$/",$Quantity)) {  
            $QuantityEr = "Please Enter A Valid Quantity";  
        }
		else if($Quantity<=0)
		{
			$QuantityEr="Please enter a quantity greater than 0";
		}
		else{
			$Quantity1=$Quantity;
		}

if($Title1!="" && $Author1!="" && $Publisher1!="" && $Cost1!="" && $Quantity1!="")
{
echo "Successful...";
    $sql = "insert into Book values('$Book_Id','$Title','$Author','$Publisher', $Edition,$Cost,$Quantity)";
 if(mysqli_query($conn,$sql))
	{
        echo "Book entered successfully";
		header("refresh:2;url=Add_Books.php");
   	}
else
	{
 		echo"Registration Unsuccessful:<hr>".mysqli_error($conn);
 		header("refresh:5;url=Add_Books.php");
	}
mysqli_close($conn);
}
}
?>
<body><br><br><br>
<?php
include('A_Fields.php');
?>
<div class="add_book">
<h1 align="center">ADD NEW BOOK</h1>
<form action="Add_Books.php" method="post">
<table width="70%" border="0" style="border-collapse: collapse;">
<tr>
<th>Book Id</th>
<td><input type="text" name="Book_Id" value="B<?php echo $i;?>" readonly required></input></td>
</tr>
<tr>
<th>Title</th>
<td><input type="text" name="Title" value="<?php echo $Title1;?>"></input>
<br><span id="error"><small><?php echo $TitleEr;?></small></span>
</td>
</tr>
<tr>
<th>Author</th>
<td><input type="text" name="Author" value="<?php echo $Author1;?>"></input>
<br><span id="error"><small><?php echo $AuthorEr;?></small></span>
</td>
</tr>
<tr>
<th>Publisher</th>
<td><input type="text" name="Publisher"  value="<?php echo $Publisher1;?>"></input>
<br><span id="error"><small><?php echo $PublisherEr;?></small></span>
</td>
</tr>
<tr>
<th>Edition</th>
<td><input type="text" name="Edition" value="<?php echo $Edition1;?>"></input>
<br><span id="error"><small><?php echo $EditionEr;?></small></span>
</td>
</tr>
<tr>
<th>Cost</th>
<td><input type="text" name="Cost" value="<?php echo $Cost1;?>" ></input>
<br><span id="error"><small><?php echo $CostEr;?></small></span>
</td>
</tr>
<tr>
<th>Quantity</th>
<td><input type="text" name="Quantity" value="<?php echo $Quantity1;?>" ></input>
<br><span id="error"><small><?php echo $QuantityEr;?></small></span>
</td>
</tr>
<tr>
<th colspan="2" style="text-align:center;"><input type="submit" value="ADD" name="add"></input></th>
</tr>
</table>
</form>
</div>
</body>
</html>


