<!DOCTYPE html>
<html>
<head>
	<title>Upadate</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/nav.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/update.css'); ?>">
	<script type ="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/update.js')?>"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<?php include 'nav.php'; ?>
	<h1 style="margin-top: 10px;margin-bottom: 10px;">Update Data</h1>
	<!-- <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"> -->
		<p id="demo"></p>
		<table width="50%" height="500px">
			<tr>
				<th>Id:</th>
				<td>
					<input type="text" id="id" name="u_id" value="" disabled>
				</td>
			</tr>
			<tr>
				<th>Name:</th>
				<td>
					<input type="text" id="name" name="u_name" value="">
				</td>
			</tr>
			<tr>
				<th>Email:</th>
				<td>
					<input type="email" id="email" name="u_email" value="">
				</td>
			</tr>
			<tr>
				<th>Country:</th>
				<td>
					<select id="country" name="u_country">
						<option value=""></option>
					</select>	
				</td>
			</tr>
			<tr>
				<th>State:</th>
				<td>
					<select id="state" name="u_state"><option value=""></option></select>
				</td>
			</tr>
			<tr>
				<th>City:</th>
				<td>
					<select id="city" name="u_city"><option value=""></option></select>					
				</td>
			</tr>
			<tr>
				<th>Password:</th>
				<td>
					<input type="password" id="password" name="u_password" value="">
					<span class="fa fa-eye p_eye" style="cursor: pointer;"></span>
				</td>
			</tr>
			<tr>
				<th>Confirm Password:</th>
				<td>
					<input type="password" id="cpassword" name="u_cpassword" value="">
					<span class="fa fa-eye cp_eye" style="cursor: pointer;"></span>
				</td>
			</tr>
			<tr>
				<td colspan="5">
					<input type="submit" id="update" name="update" value="update">
				</td>
			</tr>
		</table>
	<!-- </form> -->
</body>
<script type="text/javascript">
	var base_url = '<?php echo base_url(); ?>';
</script>
</html>