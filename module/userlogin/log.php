<?php
if(isset($_POST['username'])){
	$username=addslashes($_POST['username']);
	$password=md5(addslashes($_POST['password']));
	$rs=mysqli_query($con,"select id,name,email,password from profile where email='$username' and password='$password'");
//	echo "select id,name,email,password from profile where email='$username' and password='$password'";exit;
	$dtl=mysqli_fetch_assoc($rs);
	if(mysqli_num_rows($rs)){
		$_SESSION['ulogin']=$dtl;
		?>
        <script>
		alert("Welcome <?php echo $_SESSION['ulogin']['name'];?>");
		location.href="index.php?mod=profile&do=profile";
		</script>
        <?php
	}
	else{
		?>
		<span style="color:red;">Please enter correct username and password</span>
		<?php
	}
}
?>