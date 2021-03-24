<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/signup.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/nav.css'); ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/signup.js'); ?>"></script>

</head>
<body>
	<?php include 'nav.php'; ?>
<div class="message">
	<span id="demo"></span>
	<span id="close"></span>
</div>
<div class="a2">
	<form>
		<table width="50%" height="500px">
			<tr>
				<th colspan="2" style="font-size: 30px;text-align: center;">Sign Up Form</th>
			</tr>
			<tr>
				<th>
					<label>Name:</label>
				</th>
				<td>
					<input type="text" id="name" name="name" placeholder="Enter Name">
				</td>
			</tr>
			<tr>
				<th>
					<label>Email:</label>
				</th>
				<td>
					<input type="email" id="email" name="email" placeholder="Enter Email">
				</td>
			</tr><tr>
				<th>
					<label>Password:</label>
				</th>
				<td>
					<input type="password" id="password" name="password" placeholder="Enter Password">
				</td>
			</tr>
			<tr>
				<th>
					<label>Confirm Password:</label>
				</th>
				<td>
					<input type="password" id="cpassword" name="cpassword" placeholder="Enter Confirm Password">
				</td>
			</tr>
			<tr>
				<th>
					<label>Country:</label>
				</th>
				<td>
					<select id="country" name="country">
						<option value="" hidden>Select Country:</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label>State:</label>
				</th>
				<td>
					<select id="state" name="state">
						<option value="" hidden>Select State:</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					<label>City:</label>
				</th>
				<td>
					<select id="city" name="city">
						<option value="" hidden>Select City:</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" id="signup" name="signup" value="Signup">&nbsp;&nbsp;
					<input type="reset" id="reset" name="reset" value="Reset">
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
</script>
</html>	