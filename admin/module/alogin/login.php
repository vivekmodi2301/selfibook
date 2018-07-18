<?php
	if(isset($_POST['username'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$admin=mysqli_query($con,"select id,username,password from admin where username='$username' and password='$password'");
			if(mysqli_num_rows($admin)){
			$_SESSION['alogin']=mysqli_fetch_assoc($admin);
				if(isset($_SESSION['alogin'])){
			?>
            	<script>
					location.href="index.php?mod=admin&do=list";
				</script>
            <?php	
				}
				else{
					echo "hii";	
				}
		}
		else{
			echo "hiiiiii";	
		}
	}
?>
<table border="1px" class="alogin">
<form method="post">
	<tr>
    	<th colspan="2">Admin Login</th>
    </tr>
    <tr>
    	<td>Username</td><td><input type="text" name="username"></td>
    </tr>
    <tr>
    	<td>Password</td><td><input type="password" name="password"></td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Submit"></td>
    </tr>
</form>
</table>