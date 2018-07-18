<?php
if(isset($_GET[id])){
	$id=$_GET[id];
}
if(isset($_POST['opassword'])){
	$pass=$_POST['newpass'];
	mysqli_query($con,"update profile set password='$pass' where id=$id");
	?>
	<script>
		location.href="index.php?mod=page&do=profile";
	</script>
	<?php
}
?>
<script src="js/jquery.js"></script>
<div class="signin">
				<form method="post">
			
			<table width="50%" cellspacing="5px" border="0px" width="100%" cellpadding="50px" style="text-align:center; margin-left:30%;" cellspacing="0">
            	<tr>
                	<th colspan="2">Change Password</th>
                </tr>
					<tr><th>Old Password</th><td><input type="password" name="opassword" onChange="cp(this.value,'<?php echo $id;?>')"></td></tr>
					<tr id="password"></tr>
					<tr><td colspan="2"><input type="submit" disabled id="bt" value="submit"></td></tr>
            	 </table>
     </form>
			
				 </div>

<script>
	function cp(pass,id){
		$.ajax({
			url:"module/page/cp.php",
			data:'password='+pass+'&id='+id,
			type:'GET',
			success:function(rs){
				$('#password').html(rs);
				bt.disabled=false;
				}
		});
	}
</script>