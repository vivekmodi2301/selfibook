<?php
	if(isset($_GET['deletepic'])){
		$picid=$_GET['deletepic'];
		$pname=mysqli_fetch_assoc(mysqli_query($con,"select name from photos where id=$picid"));
		$pname['name']="upphotos/".$pname['name'];
		//echo $pname['name'];exit;
		mysqli_query($con,"delete from photos where id=$picid");
		array_map('unlink',glob($pname['name']));
		?>
        	<script>
				location.href="index.php?mod=profile&do=images";
			</script>
        <?php
	}
?>