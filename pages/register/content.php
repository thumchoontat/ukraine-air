<!-- Register page content -->
<div class="content content-sm">
	<form method="POST" action="">
		<label class="error"><?php 
			if (!$user->validDisplayName() && !$user->isEmpty()){
				echo 'Invalid display name';
			}
		?></label>
		<div class="input-group">
			<span class="input-group-addon">Display Name</span>
			<input 
				class="form-control" 
				type="text" 
				name="display-name" 
				value="<?php echo $user->getDisplayName(); ?>"
				data-toggle="popover"
				title="Display Name"
				data-placement="right"
				data-html="true"
				data-content="The allowed charcaters are:<br/>
				- case insensitive alphabetic characters<br/>
				- period (.)<br/>
				- space ( )<br/>
				<b>Must contain 3 to 100 characters</b>
				"
			/>
		</div>
		
		<label class="error"><?php 
			if (!$user->validUsername() && !$user->isEmpty()){
				echo 'Invalid username';
			}
		?></label>
		<div class="input-group">
			<span class="input-group-addon">Username</span>
			<input 
				class="form-control" 
				type="text" 
				name="username" 
				value="<?php echo $user->getUsername(); ?>"
				data-toggle="popover"
				title="Username"
				data-placement="right"
				data-html="true"
				data-content="The allowed charcaters are:<br/>
				- case insensitive alphabetic characters<br/>
				- numeric characters<br/>
				- period (.)<br/>
				- underscore (_)<br/>
				<b>Must contain 5 to 50 characters</b>
				"
			/>
		</div>
		
		<label class="error"><?php 
			if (!$user->validPassword() && !$user->isEmpty()){
				echo 'Invalid password';
			}
		?></label>
		<div class="input-group">
			<span class="input-group-addon">Password</span>
			<input 
				class="form-control" 
				type="password" 
				name="password"
				data-toggle="popover"
				title="Password"
				data-placement="right"
				data-html="true"
				data-content="<b>Must contain 8 to 50 characters</b>"
			/>
		</div>
		
		
		<label class="error"><?php 
			if (!$user->passwordsMatch() && !$user->isEmpty()){
				echo 'Passwords does not match';
			}
		?></label>
		<div class="input-group">
			<span class="input-group-addon">Reenter Password</span>
			<input 
				class="form-control" 
				type="password" 
				name="val-password"
				data-toggle="popover"
				title="Reenter Password"
				data-placement="right"
				data-html="true"
				data-content="<b>Reenter the password to continue</b>"
			/>
		</div>
		<br/>
		<div class="actions">
			<button class="btn btn-primary">Register</button>
			<button class="btn btn-warning clear">Clear</button>
			<br/><br/>
			Already have an account? Login <a href="login">here</a>
		</div>
		
	</form>
</div>