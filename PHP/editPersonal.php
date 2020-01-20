<html>
<head>
<link rel="stylesheet" type="text/css" href="css/input-style.css">
<?php
	include('headStyle.php');
?>

<style>
	div.lookgood{
		margin-top:150px;
		margin-left:150px;
	}
	h3.header{
		margin-left:-25px;
	}
	input.button{
		margin-right:50px;
	}
	f1{
        width:100%;
        height:4.5%;
        position:absolute;
        bottom:0px;
        left: 50%;
        transform: translateX(-50%);
    }
</style>

</head>
	<body style="background-image: url('img/sky.jpg');background-attachment: fixed;">
		<?php
			include("header.php");
			if(!$_SESSION['id']){
				header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
				}//if someone use url to get in this page without login, jump to SignIn.php
		?>

		<?php
				include('db.php');
				$id = $_SESSION['id'];
				// Determine account type
        $stmt = $mysql->prepare("SELECT type,username,email FROM accountInfo WHERE id = :ID");
        $stmt->bindParam(":ID", $id);
        $stmt->execute();
        $result=$stmt->fetchAll();
        foreach($result as $row2 ){
          $type=$row2['type'];

					// If a customer, get customer info
					if($type="Customer"){
						$stmt = $mysql->prepare("SELECT * from customerInfo where id = :ID");
						$stmt->bindParam(":ID", $id);
						$stmt->execute();
						$results=$stmt->fetchall();

						// Display editable info with their current values in inputbox
						foreach($results as $row) {

							echo "<div class='lookgood'>
									<form action='editPersonal.php' method='post'>
										<ul class='form-style-1'>
											<h3 class='header'> Personal Details </h3>
											<li>
												<label>Firstname <span class='required'>*</span></label>
												<input type='text' name='firstname' value='".$row["forename"]."'class='field-long'/>
											</li>
											<li>
												<label>Surname<span class='required'>*</span></label>
												<input type='text' name='surname' value='".$row['surname']."'class='field-long' />
											</li>
											<li>
												<label>Date of Birth<span class='required'>*</span></label>
												<input type='date' name='dob'  value='".$row['date_of_birth']."'class='field-long' />
											</li>
											<li>
												<label>Phone Number<span class='required'>*</span></label>
												<input type='text' name='phone' value='".$row['phone_number']."'class='field-long' />
											</li>
											<li>
												<input  type='submit' name='submitEditCustomer' value='submit'/>
											</li>
										</ul>
									</form>
								</div>";
						}

					if( isset($_POST['submitEditCustomer']) ){

						// Recieve customer details
						$firstname = $_POST['firstname'];
						$surname = $_POST['surname'];
						$dob = $_POST['dob'];
						$phone = $_POST['phone'];

						// update customer details
						$stmt = $mysql->prepare("UPDATE customerinfo SET
							forename=:First,
							surname=:Last,
							date_of_birth=:DOB,
							phone_number=:Phone
	 						where id=:ID");
						$stmt->bindParam(":ID", $id);
						$stmt->bindParam(":First", $firstname);
						$stmt->bindParam(":Last", $surname);
						$stmt->bindParam(":DOB", $dob);
						$stmt->bindParam(":Phone", $phone);

						$stmt->execute();
						$message = "Details Changed.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/php/myDetails.php'</script>";
					}
				}
					// If staff, get staff details
					if($type="Staff"){
						$stmt = $mysql->prepare("SELECT * from staffInfo where id = :ID");
						$stmt->bindParam(":ID", $id);
						$stmt->execute();
						$results=$stmt->fetchall();

						foreach($results as $row) {
							// Display editable info with their current values in inputbox
							echo "<div class='lookgood'>
									<form action='editPersonal.php' method='post'>
										<ul class='form-style-1'>
											<h3 class='header'> Personal Details </h3>
											<li>
												<label>Firstname <span class='required'>*</span></label>
												<input type='text' name='firstname' value='".$row["forename"]."'class='field-long'/>
											</li>
											<li>
												<label>Surname<span class='required'>*</span></label>
												<input type='text' name='surname' value='".$row['surname']."'class='field-long' />
											</li>
											<li>
												<label>Date of Birth<span class='required'>*</span></label>
												<input type='date' name='dob'  value='".$row['date_of_birth']."'class='field-long' />
											</li>
											<li>
												<label>Phone Number<span class='required'>*</span></label>
												<input type='text' name='phone' value='".$row['phone_number']."'class='field-long' />
											</li>
											<li>
												<input  type='submit' name='submitEditStaff' value='submit'/>
											</li>
										</ul>
									</form>
								</div>";
						}

					if( isset($_POST['submitEditStaff']) ){

						// Recieve staff details
						$firstname = $_POST['firstname'];
						$surname = $_POST['surname'];
						$dob = $_POST['dob'];
						$phone = $_POST['phone'];

						// Insert new staff row into staffinfo view
						$stmt = $mysql->prepare("UPDATE staffinfo SET
							forename=:First,
							surname=:Last,
							date_of_birth=:DOB,
							phone_number=:Phone
	 						where id=:ID");
						$stmt->bindParam(":ID", $id);
						$stmt->bindParam(":First", $firstname);
						$stmt->bindParam(":Last", $surname);
						$stmt->bindParam(":DOB", $dob);
						$stmt->bindParam(":Phone", $phone);

						$stmt->execute();
						$message = "Details Changed.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/php/myDetails.php'</script>";
					}
				}
			}
		?>

		<f1>
		<?php
			readfile("footer.html")
		?>
</f1>
	</body>
</html>
