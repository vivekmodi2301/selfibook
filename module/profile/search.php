<?php
	if(isset($_GET['frdreq'])){
		$frid=$_GET['frdreq'];
		$usid=$_GET['uid'];
		$sea=$_GET['search'];
		sendRequest($usid,$frid);	
		?>
        	<script>
				location.href="index.php?mod=profile&do=search&search=<?php echo $sea;?>";
			</script>
        <?php
	}
	if(isset($_GET['deleid'])){
		$delid=$_GET['deleid'];
		$sea=$_GET['search'];
		deleteRequest($delid);
		?>
        	<script>
				location.href="index.php?mod=profile&do=search&search=<?php echo $sea;?>";
			</script>
        <?php
	}
	if(isset($_GET['deleteid'])){
		$dele=$_GET['deleteid'];
		$userid=$_GET['userid'];
		$friendid=$_GET['friendid'];
		$sea=$_GET['search'];
		acceptRequest($userid,$friendid,$dele);
		?>
        	<script>
				location.href="index.php?mod=profile&do=search&search=<?php echo $sea;?>";
			</script>
        <?php
	}
	if(isset($_REQUEST['search'])){
		if(!$_REQUEST['search']){
			?>
            <span style="color:red;">Please write something to search someone</span>
            <?php
		}else{
		$search=$_REQUEST['search'];
		$uid=$_SESSION['ulogin']['id'];
		$rs=mysqli_query($con,"select profile.id, profile.name, gender, city.city , state.state, mobile, photos.name as photo from profile left join city on cityid=city.id left join state on profile.stateid=state.id left join photos on propic=photos.id where profile.name like '%$search%' and profile.id!=$uid");
		while($user=mysqli_fetch_assoc($rs)){
			$fid=$user['id'];
			?>
            <a href="index.php?mod=profile&do=profile&id=<?php echo $user['id'];?>">
            	<table cellspacing="15px">
                	<tr>
                    	<td rowspan="4"><img src="<?php
							if($user['photo']){
								echo UIMAGE.$user['photo'];	
							}
							else{
								echo IMAGE.$user['gender'].".png";	
							}
						 ?>" height="100px" width="100px"></td>
                         <td>Name</td>
                         <td><?php echo $user['name'];?></td>
                    </tr>
                    <tr>
                    	<td>State</td>
                        <td><?php echo $user['city'].",".$user['state'];?></td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        <?php
							echo mysqli_num_rows(mysqli_query($con,"select id,uid as friend,fid from friends where uid=$fid or fid=$fid"))."  Friends";
						?>
                        </td>
                    </tr>
                    <tr>
                    <td colspan="2">
                    	<?php
							$uid=$_SESSION['ulogin']['id'];
							$fid=$user['id'];
							$rsa=mysqli_num_rows(mysqli_query($con,"select id,uid,fid from friends where uid=$uid and fid=$fid or uid=$fid and fid=$uid"));
                    	 if(!$rsa){
							$rsaa=mysqli_num_rows(mysqli_query($con,"select id,uid,fid from friendreq where uid=
$uid and fid=$fid"));
							if($rsaa){
								echo "friend request send";			
							}else{
								$qry=mysqli_query($con,"select id,uid,fid from friendreq where uid=$fid and fid=$uid");
								$rsaaa=mysqli_fetch_assoc($qry);
								$friendid=mysqli_num_rows($qry);
								if($friendid){?>
									<a href="index.php?mod=profile&do=search&search=<?php echo $search;?>&userid=<?php echo $uid;?>&friendid=<?php echo $fid;?>&deleteid=<?php echo $rsaaa['id'];?>">Confirm Request</a><a href="index.php?mod=profile&do=search&search=<?php echo $search;?>&deleid=<?php echo $rsaaa['id'];?>">Delete Request</a>	
                                    <?php
								}else{
								?>
								<a href="index.php?mod=profile&do=search&search=<?php echo $search;?>&frdreq=<?php echo $fid;?>&uid=<?php echo $uid;?>">Send Friend Request</a>
                                <?php	
								}
							}
						}
						else{
							echo "Friends";	
						}
						 ?>
                        </td>
                    </tr>
                </table>
                <hr>
            <?php
		}
		}
	}
?>