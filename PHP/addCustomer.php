<html>
<head>
</head>
<body>
<?php
	include("header.php");
	include("db.php");
	// If a form is submited.
	if( isset($_POST['submit']) ){

		// Check if the customer already signed up for a course
		$stmt = $mysql->prepare("SELECT * from customerinfo where id = :ID");
		$stmt->bindParam(":ID", $_SESSION['id']);
		$stmt->execute();
		$results=$stmt->fetchall();

		// Display a message if they already have signed up for a course.
		if($stmt->rowCount() > 0){
			$message = "You already signed up for a course.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12'</script>";
		}
		else{

			// Insert details into customerinfo
			$stmt = $mysql->prepare("INSERT INTO customerinfo (forename,surname, date_of_birth, phone_number, address, term_id,id)
			VALUE (:First,:Last,:DOB,:Phone,:Address,:Term_ID,:ID)");

			$stmt->bindParam(":ID", $_SESSION['id']);
			$stmt->bindParam(":First", $firstname);
			$stmt->bindParam(":Last", $surname);
			$stmt->bindParam(":DOB", $dob);
			$stmt->bindParam(":Phone", $phone);
			$stmt->bindParam(":Address", $address);
			$stmt->bindParam(":Term_ID", $term_id);

			$firstname = $_POST['firstname'];
			$surname = $_POST['surname'];
			$dob = $_POST['dob'];
			$phone = $_POST['phone'];
			$address = $_POST['address1'] . " ". $_POST['address2']." ".$_POST['address3']." ".$_POST['city'];
			$term_id = $_POST['branch'].$_POST['course'].$_POST['term'];

			$stmt->execute();

			// Check if insert was succesful
			$stmt = $mysql->prepare("SELECT * from customerinfo where id = :ID");
			$stmt->bindParam(":ID", $_SESSION['id']);
			$stmt->execute();
			$results=$stmt->fetchall();

			// If signup is Successful
			if($stmt->rowCount() == 1){

				$message = "Sign Up Successful";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12'</script>";
			}
			else{
				$message = "Sign Up Failed.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12'</script>";
			}
		}
	}

?>
