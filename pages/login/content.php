<!-- Login page content -->
<div class="content content-sm">
	<form method="POST" action="">
		<div class="input-group">
			<span class="input-group-addon">Username</span>
			<input class="form-control" type="text" name="username" value="<?php echo $user->getUsername(); ?>" autofocus="autofocus"/>
		</div>
		<div class="input-group">
			<span class="input-group-addon">Password</span>
			<input class="form-control" type="password" name="password"/>
		</div>
		<br/>
		<div class="actions">
			<button class="btn btn-primary">Login</button>
			<br/><br/>
			Don't have an account? Register <a href="register">here</a>
		</div>
		
	</form>
</div>