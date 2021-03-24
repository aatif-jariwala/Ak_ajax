<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/nav.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/display.css'); ?>">
	<script type="text/javascript" src="<?php echo base_url('assets/js/display.js')?>"></script>

	<title>Display</title>
</head>
<body>
<?php 
	include "nav.php";
		if($this->session->userdata('loggedin')){ 
?>
			<h1 style="text-align: center;"><?php echo "welcome ".$this->session->userdata('name'); ?></h1>
			<br>

			<table border="1" id="user_display">
				<tr id="data">
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th>Password</th>
					<th>Confirm Password</th>
				</tr>
			</table>
<?php	
	} //if loop loggedin true
	else{ //else loop loggedin false
?>

		<h1 style="text-align: center;margin-top: 10px;margin-bottom: 10px;">Display Data</h1> 

		<!-- <input type="text" id="search" name="search" placeholder="Search"> -->

		<table border="1" id="display_table">
			<tr id="table_row">
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Country</th>
				<th>State</th>
				<th>City</th>
				<th>Password</th>
				<th>Confirm Passowrd</th>
			</tr>
<?php 
	}//else loop loggedin false	
?> 		
		
	</table>
</body>
<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
	var session = false;
	<?php  
		if($this->session->userdata('loggedin')){ ?>
			session = true;
	<?php 
		}
		else{	?>
			session = false;
	<?php 
		}
	 ?>
</script>
</html>