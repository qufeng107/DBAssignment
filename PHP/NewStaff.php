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
		<div class="lookgood">
			<form action="addStaff.php" method="post">
				<ul class="form-style-1">
					<h3 class="header"> Personal Details </h3>
					<li>
						<label>Firstname <span class="required">*</span></label>
						<input type="text" name="firstname" class="field-long"/>
					</li>
					<li>
						<label>Surname<span class="required">*</span></label>
						<input type="text" name="surname" class="field-long" />
					</li>
					<li>
						<label>Date of Birth<span class="required">*</span></label>
						<input type="date" name="dob" class="field-long" />
					</li>
					<li>
						<label>Phone Number<span class="required">*</span></label>
						<input type="text" name="phone" class="field-long" />
					</li>
					<h3 class="header"> Job Details </h3>
					<li>
						<label>Branch</label>
						<select name="branch" class="field-short">
						<option value="UK - London">London</option>
						<option value="UK - Edinburgh">Edinburgh</option>
						<option value="Finland - Helsinki">Finland</option>
						<option value="US - Washington DC">USA</option>
						</select>
					</li>
					<li>
						<label>Job</label>
						<select name="job_title" class="field-short">
						<option value="Instructor">Instructor</option>
						<option value="Mechanic">Mechanic</option>
						</select>
					</li>
					<li>
						<label>Salary <span class="required">*</span></label>
						<input type="number" name="salary" class="field-long" />
					</li>
					<li>
						<input  type="submit" name="submit" value="submit"/>
					</li>
				</ul>
			</form>
		</div>
		<?php
			readfile("footer.html");
		?>
	</body>
<html>
