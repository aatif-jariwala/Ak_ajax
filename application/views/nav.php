<nav>
	<ul>
		<li id="nav_display"><a href="display">Display</a></li>
		<?php if($this->session->userdata('loggedin')){ ?>
		<li id="nav_update"><a href="update">Update</a></li>
		<li id="delete"><a href="delete">Delete</a></li>
		<li id="nav_logout"><a href="logout">Logout</a></li>

		<?php }else{ ?>
		<li id="nav_login"><a href="login">Login</a></li>
		<li id="nav_signup"><a href="signup">Signup</a></li>
		<?php } ?>
	</ul>
</nav>

