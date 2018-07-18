<?php
	include_once("../../config.php");
	include_once("../../function.php");
	if(isset($_GET['state'])){
		$state=$_GET['state'];
		$rs=mysqli_query($con,"select id,city,stateid from city where stateid=$state");
		while($city=mysqli_fetch_assoc($rs)){
		?>
      <option value="<?php echo $city['id'];?>"><?php echo $city['city'];?></option>
        <?php
		}
	}
?>