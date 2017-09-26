<div class="header">
	<nav class="nav navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="/" class="navbar-brand">UIA</a>
			</div>
			<div class="collapse navbar-collapse navbar-left">
				<ul class="nav navbar-nav">
					<li <?php echo preg_match('/pages\/(home|)(\/|)$/',$pageDir) ? 'class="active"':''; ?>>
						<a href="/">Home</a>
					</li>
					<?php if ($validUser){ ?>
					<li <?php echo preg_match('/pages\/(booking)(\/|)/',$pageDir) ? 'class="active"':''; ?>>
						<a href="/booking">Booking</a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class="collapse navbar-collapse navbar-right">
				<?php if (!$validUser) { ?>
					<a href="register" class="btn btn-info navbar-btn">Register</a>
					<a href="login" class="btn btn-success navbar-btn">Login</a>
				<?php }
					  else{ ?>
					  Welcome, <?php echo $displayName; ?>
					<a href="/logout" class="btn btn-success navbar-btn">Logout</a>
				<?php } ?>
			</div>
		</div>
	</nav>
</div>