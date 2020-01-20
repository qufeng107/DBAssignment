<html>
<head>
<link rel="stylesheet" type="text/css" href="css/input-style.css">
<?php
	readfile('headStyle.html');
?>

<style>
	div.lookgood{
		margin-top:150px;
		margin-left:150px;
	}
	h3.header{
		margin-left:-25px;
	}
</style>

</head>
	<body>
		<?php
			readfile("header.html")
		?>
		<div class="lookgood">
			<form action="addCustomer.php" method="post">
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
					<li>
						<label>Email <span class="required">*</span></label>
						<input type="email" name="email" class="field-long" />
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
						<option value="4">Commercial Pilot</option>
						<option value="2">Multi-Crew Pilot</option>
						<option value="3">Airline Transport Pilot</option>
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
						<input type="submit" name="submit" value="submit" />
					</li>
				</ul>
			</form>
		</div>
		<?php
			readfile("footer.html");
		?>
	</body>
<html>
