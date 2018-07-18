<?php
	print_r($_POST);
	include_once("../../config.php");
	include_once("../../function.php");
	$err="";
	if(isset($_POST['name'])){
		if(!$_POST['name']){
			$err.="Enter your name<br>";
			?>
            <script>
				document.getElementById('name').focus();
			</script>
            <?php
		}
			if(!$_POST['gender']){
			$err.="Select Your gender<br>";
			?>
            <script>
				document.getElementById('gender').focus();
			</script>
            <?php
		}
		if(!$_POST['email']){
			$err.="Enter your email<br>";
			?>
            <script>
				document.getElementById('email').focus();
			</script>
            <?php
		}
		if(!$_POST['name']){
			$err.="Enter your password<br>";
			?>
            <script>
				document.getElementById('password').focus();
			</script>
            <?php
		}
		if(!$_POST['name']){
			$err.="Enter your dob<br>";
			?>
            <script>
				document.getElementById('dob').focus();
			</script>
            <?php
		}
		if($err){
			?>
			<script>
				location.href="../../index.php?mod=userlogin&do=login&err=<?php echo $err;?>";
			</script>
            <?php
		}
		else{
				$_POST['dob']=implode('/',$_POST['dob']);
			?>
            <script>
				alert("You has been successfully SignIn.");
			</script>
                        <?php
						$_POST['password']=md5($_POST['password']);
						addEdit('profile',$_POST);?>
						<script>
							location.href="../../index.php?mod=userlogin&do=login";
						</script>
                        <?php
	}
	}
?>