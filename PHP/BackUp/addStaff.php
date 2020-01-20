<html>
<head>
</head>
<body>
<?php
	include "db.php";
	if( isset($_POST['submit']) ){

		$stmt = $mysql->prepare("INSERT INTO customer (firstname,surname, date_of_birth, phone_number, address, city, term_id,id)
		VALUE (:First,:Last,:DOB,:Phone,:Address,:City,:Term_ID,1)");
				
		$stmt->bindParam(":First", $firstname);
		$stmt->bindParam(":Last", $surname);
		$stmt->bindParam(":DOB", $dob);
		$stmt->bindParam(":Phone", $phone);
		$stmt->bindParam(":Address", $address);
		$stmt->bindParam(":City", $city);
		$stmt->bindParam(":Term_ID", $term_id);	
		
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];
		$dob = $_POST['dob'];
		$phone = $_POST['phone'];
		$address = $_POST['address1'] . " ". $_POST['address2']." ".$_POST['address3'];
		$city = $_POST['city'];
		$term_id = $_POST['course'].$_POST['term'];
		 
		$stmt->execute();

	echo "CUSTOMER ADDED";
	}
	else{
		echo "failed";
	}
?>