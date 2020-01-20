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
</style>

</head>
	<body>
		<?php
			include("header.php");
			if(!$_SESSION['id']){
				header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
				}//if someone use url to get in this page without login, jump to SignIn.php
		?>

		<?php
				include('db.php');
				$id = $_COOKIE["selectedStaff"];
				// Get staff details
				$stmt = $mysql->prepare("SELECT * from staffinfo where id = :ID");
				$stmt->bindParam(":ID", $id);
				$stmt->execute();
				$results=$stmt->fetchall();

				// Display all editable staff details with their current values in the input boxes
				foreach($results as $row) {

					echo "<div class='lookgood'>
							<form action='editStaff.php' method='post'>
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
									<h3 class='header'> Job Details </h3>
									<li>
										<label>Branch</label>
										<select name='branch' class='field-short'>
										<option selected='selected'>".$row['branch_name']."</option>
										<option value='UK - London'>London</option>
										<option value='UK - Edinburgh'>Edinburgh</option>
										<option value='Finland - Helsinki'>Finland</option>
										<option value='US - Washington DC'>USA</option>
										</select>
									</li>
									<li>
										<label>Job</label>
										<select name='job_title' class='field-short'>
										<option selected='selected'>".$row['job_title']."</option>
										<option value='Instructor'>Instructor</option>
										<option value='Mechanic'>Mechanic</option>
										</select>
									</li>
									<li>
										<label>Salary <span class='required'>*</span></label>
										<input type='number' name='salary' value='".$row['annual_salary']."' class='field-long' />
									</li>
									<li>
										<input  type='submit' name='submitEdit' value='submit'/>
									</li>
								</ul>
							</form>
						</div>";
				};

				if( isset($_POST['submitEdit']) ){

					// Recieve currently logged in staffs details
					$branch = $_POST['branch'];
					$firstname = $_POST['firstname'];
					$surname = $_POST['surname'];
					$dob = $_POST['dob'];
					$phone = $_POST['phone'];
					$job = $_POST['job_title'];
					$salary = $_POST['salary'];

					// Update currently logged in staffs details
					$stmt = $mysql->prepare("UPDATE staffinfo SET
						branch_name=:Branch,
						forename=:First,
						surname=:Last,
						date_of_birth=:DOB,
						phone_number=:Phone,
						job_title=:Job,
						annual_salary=:Salary where id=:ID");


					$stmt->bindParam(":ID", $id);
					$stmt->bindParam(":Branch", $branch);
					$stmt->bindParam(":First", $firstname);
					$stmt->bindParam(":Last", $surname);
					$stmt->bindParam(":DOB", $dob);
					$stmt->bindParam(":Phone", $phone);
					$stmt->bindParam(":Job", $job);
					$stmt->bindParam(":Salary", $salary);

					$stmt->execute();
					$message = "Staff Edited.";
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo "<script>window.location = 'https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/php/displayStaff.php'</script>";


				}
		?>

		<?php
			readfile("footer.html");
		?>
	</body>
</html>
