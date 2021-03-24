<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/nav.css'); ?>">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/login.js'); ?>"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<!-- <form  method="post"> -->
		<?php include "nav.php"; ?>
	<div id="message">
		<span id="demo"></span>
		<span id="close"></span>
	</div>
		<i id="user_circle" class="fa fa-user-circle fa-5x"></i>
		<table width="40%" height="350px">
			<tr>
				<td>
				<h1 style="text-align: center; margin-top: 30px;margin-bottom: 10px;">Login Form</h1>
				</td>
			</tr>
			<tr>
				<td>
					<i class="fa fa-user fa-2x"></i>
					<input type="text" id="name" name="name" placeholder="Username">
				</td>
			</tr>
			<tr>
				<td>
					<i class="fa fa-lock fa-2x"></i>
					<input type="password" id="password" name="password" placeholder="Password">
					<span class="fa fa-eye"></span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="login" id="login" value="login">
				</td>
			</tr>
		</table>
		
	<!-- </form> -->
</body>
<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
</script>
</html>