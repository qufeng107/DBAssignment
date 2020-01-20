<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/input-style.css">
	<?php
		readfile("headStyle.html")
	?>
</head>
	<body>
		<?php
			readfile("header.html")
		?>
		<div id="service" class="section-padding">
			<div class="container">
				<div class="row">
	        <div class="page-title text-center">
		<form action="../PHP/addStaff.php" method="post">
			<ul class="form-style-1">
				<h3> Personal Details </h3>
				<li>
					<label>Firstname <span class="required">*</span></label>
					<input type="text" name="firstname" class="field-short"/>
				</li>
				<li>
					<label>Surname<span class="required">*</span></label>
					<input type="text" name="surname" class="field-short" />
				</li>
				<li>
					<label>Date of Birth<span class="required">*</span></label>
					<input type="date" name="dob" class="field-short" />
				</li>
				<li>
					<label>Phone Number<span class="required">*</span></label>
					<input type="text" name="phone" class="field-short" />
				</li>
				<li>
					<label>Email <span class="required">*</span></label>
					<input type="email" name="email" class="field-short" />
				</li>
				<h3> Job Details </h3>
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
					<option value="Lecturer">Lecturer</option>
					<option value="Mechanic">Mechanic</option>
					</select>
				</li>
				<li>
					<input type="submit" name="submit" value="submit" />
				</li>
			</ul>
		</form>
	</div>
</div>
	</div>
	</div>
		<?php
			readfile("footer.html")
		?>
	</body>
<html>
https://www.sanwebe.com/2014/08/css-html-forms-designs
