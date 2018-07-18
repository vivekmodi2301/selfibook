<?php
	if(isset($_GET['propic'])){
		$picid=$_GET['propic'];
		$uid=$_SESSION['ulogin']['id'];
		$deta=mysqli_fetch_assoc(mysqli_query($con,"select id,propic from profile where id=$uid"));
		if($deta['propic']){
			$qry="update profile set propic=$picid where id=$uid";	
		}
		else{
			$qry="update profile set propic=$picid where id=$uid";	
		}
		mysqli_query($con,$qry);
		?>
        	<script>
				location.href="index.php?mod=profile&do=images";
			</script>
        <?php
	}
?>