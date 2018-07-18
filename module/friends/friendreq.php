<?php
	if(isset($_GET['deleid'])){
		$delid=$_GET['deleid'];
		deleteRequest($delid);
		?>
        	<script>
				location.href="index.php?mod=friends&do=friends";
			</script>
        <?php
	}
	if(isset($_GET['deleteid'])){
		$dele=$_GET['deleteid'];
		$userid=$_GET['userid'];
		$friendid=$_GET['friendid'];
		acceptRequest($userid,$friendid,$dele);
		?>
        	<script>
				location.href="index.php?mod=friends&do=friends";
			</script>
        <?php
	}
	if(isset($_SESSION['ulogin'])){
		$uid=$_SESSION['ulogin']['id'];
		$rs=mysqli_query($con,"select id,fid,uid from friendreq where fid=$uid");
		$i=1;
		?>
        <br>
        <a href="index.php?mod=friends&do=sentreq" style="margin-left:45%;">View Sent Friend Request</a>
        <br>
        	<div class="friend">
                <?php
				if(mysqli_num_rows($rs)){
		while($friends=mysqli_fetch_assoc($rs)){
			if($i==5){
					?>
                    </div>
                    <div class="friend">
                    <?php $i=1; }
					$i++;
				$friend=$friends['uid'];
			$detail=mysqli_query($con,"select profile.id,profile.name as user,photos.name as photo,state,city,gender from profile join state on stateid=state.id join city on cityid=city.id left join photos on profile.propic=photos.id where profile.id=$friend");
				while($det=mysqli_fetch_assoc($detail)){
						$fid=$det['id'];				?>
                        <table class="friends" border="0px" cellspacing="15px">
            	<tr>
                 		<td width="120px" rowspan="3">
                        	<img src="<?php if($det['photo']){echo UIMAGE.$det['photo'];} else{ echo IMAGE.$det['gender'].".png"; } ?>" height="100px" width="100px">
                        </td>   
                        <td><?php echo strtoupper(strtolower($det['user']));?></td>
                        </tr>
                        <tr>
                        	<td><?php
							echo mysqli_num_rows(mysqli_query($con,"select id,uid as friend,fid from friends where uid=$fid or fid=$fid"))."  Friends";
						?></td>
                        </tr>
                        <tr>
                        	<td>
                            <a href="index.php?mod=friends&do=friendreq&userid=<?php echo $uid;?>&friendid=<?php echo $fid;?>&deleteid=<?php echo $friends['id'];?>">Confirm Request</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a href="index.php?mod=friends&do=friendreq&deleid=<?php echo $friends['id'];?>">Delete Request</a>
                       </td>
                        </tr>
                    <?php	
					
				}
		}
	}
	else{
		?>
        	<span style="color:red;">No Friend Request</span>
        <?php	
	}
	}
?>