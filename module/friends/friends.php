<?php
	if(isset($_GET['accid'])){
		$id=$_GET['accid'];
		$uid=$_GET['uid'];
		$fid=$_GET['fid'];
	}
	if(isset($_GET['delreq'])){
		$id=$_GET['delreq'];
		deleteRequest($id);	
	}
	if(isset($_GET['sentuid'])){
		$uid=$_GET['sentuid'];
		$fid=$_GET['fid'];
		sendRequest($uid,$fid);
	}
	if(isset($_GET['unuid'])){
		$usid=$_GET['unuid'];
		$fid=$_GET['fid'];
		unfriend($usid,$fid);
		?>
        	<script>
				location.href="index.php?mod=friends&do=friends";
			</script>
        <?php	
	}
	if(isset($_SESSION['ulogin'])){
		if(isset($_GET['id'])){
			$uid=$_GET['id'];
		}
		else{
			$uid=$_SESSION['ulogin']['id'];
		}
		$rs=mysqli_query($con,"select id,fid,uid from friends where uid=$uid or fid=$uid");
		$i=1;
		?>
        <div class="friend">
                <?php
		while($friends=mysqli_fetch_assoc($rs)){
			if($i==5){
					?>
                    </div>
                    <div class="friend">
                    <?php $i=1; }
					$i++;

			if($friends['uid']==$uid){
				$friend=$friends['fid'];
			}
			else{
				$friend=$friends['uid'];
			}
			?>
            <a href="index.php?mod=profile&do=profile&id=<?php echo $friend;?>">
			<table class="friends" border="0px" cellspacing="15px">
            	<tr>
                <?php
			$detail=mysqli_query($con,"select profile.id,profile.name as user,photos.name as photo,state,city,gender from profile join state on stateid=state.id join city on cityid=city.id left join photos on profile.propic=photos.id where profile.id=$friend");
				$det=mysqli_fetch_assoc($detail);
						$fid=$det['id'];				?>
                 		<td rowspan="3" width="120px">
                        	<img src="<?php if($det['photo']){echo UIMAGE.$det['photo'];} else{ echo IMAGE.$det['gender'].".png"; } ?>" height="100px" width="100px">
                        </td>   
                        <td><?php echo strtoupper(strtolower($det['user']));?></td>
                        </tr>
                        <tr>
                        	<td><?php
							echo mysqli_num_rows(mysqli_query($con,"select id,uid as friend,fid from friends where uid=$fid or fid=$fid"))."  Friends";
						?></td>
                        </tr>
                        <?php
						$uuid=$_SESSION['ulogin']['id'];
							$rss=mysqli_num_rows(mysqli_query($con,"select id,uid,fid from friends where uid=$uuid and fid=$fid or uid=$fid and fid=$uuid"));
							if($rss){
						?>
                        <tr>
                        	<td><a href="index.php?mod=friends&do=friends&unuid=<?php echo $uid;?>&fid=<?php echo $det['id'];?>">Unfriend</a></td>
                        </tr>
                   	<?php }else{
						$rsss=mysqli_query($con,"select id,uid,fid from friendreq where uid=$uuid and fid=$fid");
						$row=mysqli_num_rows($rsss);
						if($row){$dte=mysqli_fetch_assoc($rsss);?>
							<tr><td><a href="index.php?mod=friends&do=friends&delreq=<?php echo $dte['id'];?>">Cancel Friend Request</a></td></tr>
                            <?php	
						}else{
							$rssss=mysqli_query($con,"select id,uid,fid from friendreq where uid=$fid and fid=$uuid");	
							$roww=mysqli_num_rows($rsss);
							if($roww){$dtee=mysqli_fetch_assoc($rsss);?>
								<tr><td><a href="index.php?mod=friends&do=friends&accid=<?php echo $dtee['id'];?>&uid=<?php echo $dtee['uid'];?>&fid=<?php echo $dtee['fid'];?>">Accept Request</a><a href="index.php?mod=friends&do=friends&delreq=<?php echo $dte['id'];?>">Delete Request</a></td></tr>
                                <?php
							}
							else{
								if($fid!==$uuid){
								?>
								<tr><td><a href="index.php?mod=friends&do=friends&sentuid=<?php echo $uuid;?>&fid=<?php echo $fid;?>">Sent Friend Request</a></td></tr>
                                <?php
								}
							}
						}	
					}?>
					
			</table>
            <?php
		}
	}
?>