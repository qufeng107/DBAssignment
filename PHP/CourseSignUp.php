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
	.box{
		width:500px;
		height:850px;
		background-color: #36304a;
		position: absolute;
		margin-top: 196px;
		margin-left:50px;
		border-radius: 10px;
		border: 2px solid #36304a;
	}
</style>

</head>
	<body  style="background-image: url('img/sky.jpg');background-attachment: fixed;">
		<?php
			include("header.php");

			if(!$_SESSION['id']){
				header('LOCATION:https://zeno.computing.dundee.ac.uk/2019-ac32006/team12/PHP/SignIn.php');
				}//if someone use url to get in this page without login, jump to SignIn.php
		?>
		<div class="lookgood">
			<form action="addCustomer.php" method="post">
				<ul class="form-style-1">
					<h3 class="header"> Personal Details </h3>
					<li>
						<label>First name <span class="required">*</span></label>
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
					<li>
						<label>Address 1<span class="required">*</span></label>
						<input type="text" name="address1" class="field-long" />
					</li>
					<li>
						<label>Address 2<span class="required">*</span></label>
						<input type="text" name="address2" class="field-long" />
					</li>
					<li>
						<label>Address 3<span class="required">*</span></label>
						<input type="text" name="address3" class="field-long" />
					</li>
					<li>
						<label>City<span class="required">*</span></label>
						<input type="text" name="city" class="field-long" />
					</li>
					<h3 class="header"> Course </h3>
					<li>
						<label>Course</label>
						<select name="course" class="field-long">
						<option value="1">Private Pilot</option>
						<option value="2">Commercial Pilot</option>
						<option value="3">Multi-Crew Pilot</option>
						<option value="4">Airline Transport Pilot</option>
						</select>
					</li>
					<li>
						<label>Branch</label>
						<select name="branch" class="field-long">
						<option value="1">London</option>
						<option value="2">Edinburgh</option>
						<option value="3">USA</option>
						<option value="4">Helsinki</option>
						</select>
					</li>
					<li>
						<label>Term</label>
						<select name="term" class="field-long">
						<option value="1">January-March</option>
						<option value="2">April-June</option>
						<option value="3">July-September</option>
						<option value="4">October-December</option>
						</select>
					</li>
					<li>
						<input type="submit" style="width: 150px;	margin-top:25px" name="submit" value="Submit" />
					</li>
				</ul>
			</form>
		</div>
		<?php
			readfile("footer.html");
		?>
	</body>
<html>
