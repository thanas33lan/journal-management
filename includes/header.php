<div class="brand clearfix">
	<h4 class="pull-left text-white" style="margin:20px 0px 0px 20px"><i class="fa fa-user"></i>&nbsp;Hello, <?php echo ucwords(htmlentities($_SESSION['name'])); ?></h4>
	<span class="menu-btn"><i class="fa fa-bars"></i></span>
	<ul class="ts-profile-nav">

		<li class="ts-account">
			<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
			<ul>
				<li><a href="change-password.php">Change Password</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</li>
	</ul>
</div>
<script>
	<?php if(isset($_SESSION['alertMessage']) && !empty($_SESSION['alertMessage'])){ ?>
		alert('<?php echo $_SESSION['alertMessage'];?>');
	<?php 
	$_SESSION['alertMessage'] = "";
	}?>
</script>