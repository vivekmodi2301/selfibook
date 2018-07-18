<?php
	if(isset($_GET['dislikeid'])){
		$did=$_GET['dislikeid'];
		$pid=$_GET['dispicid'];
		mysqli_query($con,"delete from likes where id=$did");
		?>
        	<script>
				location.href="index.php?mod=photo&do=show&pid=<?php echo $pid;?>"
			</script>
        <?php
	}
	if(isset($_GET['likephoto'])){
		$pid=$_GET['likephoto'];
		$_POST['pid']=$pid;
		$_POST['uid']=$_SESSION['ulogin']['id'];
		addEdit('likes',$_POST);?>
		<script>
			location.href="index.php?mod=photo&do=show&pid=<?php echo $pid;?>";
		</script>
        <?php
	}
	//to delete comment
	if(isset($_GET['dcomid'])){
		$comid=$_GET['dcomid'];
		$pid=$_GET['picid'];
		dComment($comid);
		?>
        	<script>
				location.href="index.php?mod=photo&do=show&pid=<?php echo $pid;?>"
			</script>
        <?php
	}
	//to post comment
	if(isset($_POST['comment'])){
		$_POST['uid']=$_SESSION['ulogin']['id'];
		$_POST['pid']=$_GET['pid'];
		addedit('comments',$_POST);	
	}
	//to show photo
	if(isset($_GET['pid'])){
		$uid=$_SESSION['ulogin']['id'];
		$pid=$_GET['pid'];
		$rs=mysqli_fetch_assoc(mysqli_query($con,"select propic,profile.id,gender,photos.time, photos.name as photo,profile.name as user,profile.id as userid, time, description from photos join profile on uid=profile.id where photos.id=$pid"));
		?>
        <table class="photoshow" style="padding:10px 5px 10px 5px" cellspacing="0px">
        	<tr>
            <?php
				if($rs['propic']){
					$imge=mysqli_fetch_assoc(mysqli_query($con,"select name from photos where id=$rs[propic]"));	
					$img=$imge['name'];
				}
				else{
					$img=mysqli_fetch_assoc(mysqli_query($con,"select gender from profile where id=$rs[id]"));
					$img.=".png";	
				}
			?>
            	<td colspan="2"><img src="<?php echo UIMAGE.$rs['photo'];?>" height="300px" width="500px"></td>
            </tr><?php
            if($rs['description']!=="Write Something About Photo..."){?>
            <tr>
            	<td colspan="2" style="padding:10px 5px 10px 5px"><?php echo $rs['description'];?></td>
            </tr>
            <?php }?>
            <tr>
            	<td style="padding:10px 0px 20px 10px;" width="15%" rowspan="3"><img src="<?php if(!$rs['propic']){ echo IMAGE.$rs['gender'].".".png; } else{ echo UIMAGE.$img;} ?>" height="40px" width="50px"></td>
                <td><?php echo $rs['user'];?></td>
            </tr>
            <tr>
            	<td>
					<?php $date=strpos($rs['time'],' ');
					echo substr($rs['time'],0,$date);
					?>
                </td>
            </tr>
            <tr>
            	<td>
                	<?php $time=strpos($rs['time'],' ');
					echo substr($rs['time'],$time);
					?>
                </td>
            </tr>
            <tr>
            	<td colspan="2">
                	Friends Taged
                    <?php
						$data=mysqli_query($con,"select profile.id, profile.name as user, photos.name from tag join profile on fid=profile.id join photos on pid=photos.id where pid=$pid");
						$i=1;
						while($tfriend=mysqli_fetch_assoc($data)){
							if($i==5){
							?>
                            </td></tr>
                            <tr><td colspan="2">
                            <?php $i=1; }?>
                            	<a href="index.php?mod=profile&do=profile&id=<?php echo $tfriend['id'];?>" style="margin-left:5px; text-decoration:none;"><?php echo ucfirst($tfriend['user']);?></a>
                            <?php
							$i++;	
						}
					?>
                </td>
            </tr>
            <tr>
            	<td colspan="2" style="padding-bottom:15px; padding-top:5px;">
                <?php $rss=mysqli_query($con,"select id,uid,pid from likes where uid=$uid and pid=$pid"); if(mysqli_num_rows($rss)){$likes=mysqli_fetch_assoc($rss)?> <a href="index.php?mod=photo&do=show&dislikeid=<?php echo $likes['id'];?>&dispicid=<?php echo $likes['pid'];?>">Dislike photo</a><?php }else{ ?>
                <a href="index.php?mod=photo&do=show&likephoto=<?php echo $pid;?>">Like Photo</a><?php } if($rs['id']==$_SESSION['ulogin']['id']){?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?mod=photo&do=propic&propic=<?php echo $pid;?>">Make Profile Picture</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="deletepic(<?php echo $pid;?>)">Delete Picture</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?mod=photo&do=tagphoto&pid=<?php echo $_GET['pid'];?>">Tag Photo</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?mod=photo&do=removetag&pid=<?php echo $pid;?>">Remove Tag</a><?php }?></td>
            </tr>
            <tr bgcolor="#D3D4D2">
            	<td colspan="2"><?php if($pepole=mysqli_num_rows(mysqli_query($con,"select id,uid,pid from likes where pid=$pid"))){echo $pepole;?> <a href="index.php?mod=photo&do=likes&pid=<?php echo $_GET['pid'];?>">Pepole</a><?php } else{?>Pepole<?php }?> Like this</td>
            </tr>
            <?php
			$uid=$_SESSION['ulogin']['id'];
			$fid=$rs['userid'];
			 if(mysqli_num_rows(mysqli_query($con,"select id,uid,fid from friends where uid=$uid and fid=$fid or uid=$fid and fid=$uid")) || $uid==$fid){ ?>
            <tr>
            	<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;"><form method="post"><textarea name="comment" row="2" cols="50"></textarea><input type="submit" value="Submit"></form></td>
            </tr>
					<?php
			}
			$url="index.php?mod=photo&do=show&pid=$pid";
		$limit=1;
	$frmdataget=$_REQUEST;
		PaginationWork(2);
$totRslt=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as tot from comments join profile on uid=profile.id join photos on pid=photos.id where pid=$pid"));
                		$rss=mysqli_query($con,"select comments.id, comments.uid, profile.name as friend,comment,comments.time from comments join profile on uid=profile.id join photos on pid=photos.id where pid=$pid order by comments.id asc limit ".$frmdata['from'].", ".$frmdata['to']);
						while($comments=mysqli_fetch_assoc($rss)){
					?>
            <tr>
            	<td colspan="2">
                <table cellspacing="5px" style="width:500px; padding-left:20px; margin-top:10px;">
                <tr>
                <td>
                	<a href="index.php?mod=profile&do=profile&id=<?php echo $comments['uid'];?>"><?php echo ucwords(strtolower($comments['friend']));?></a>
                </td>
                </tr>
                <tr>
                <td>
                	<?php echo $comments['comment'];?>
                </td>
                </tr>
                <tr>
                	<td><?php echo $comments['time'];?></td>
                </tr>
             	<?php if($comments['uid']==$_SESSION['ulogin']['id']){
					?>
                <tr>
                	<td><a href="#" onClick="deleteComment(<?php echo $comments['id'];?>)">Delete Comment</td>
                </tr>
                <?php }?>
                </table>
                </td>
            </tr>
            <?php }?>
            <tr><td colspan="2"><?php PaginationDisplay($totRslt['tot'],$url.'&pageNumber=','',2,'View More Comments');?></td></tr>
        </table>
        <?php
	}
?>
<script>
	function deletepic(picid){
		if(confirm("Do you really want to Delete photo")){
			location.href="index.php?mod=photo&do=deletepic&deletepic=<?php echo $pid;?>";	
		}
	}
	function deleteComment(comid){
		if(confirm("Do you really want to Delete Comment")){
			location.href="index.php?mod=photo&do=show&dcomid="+comid+"&picid=<?php echo $pid;?>";	
		}
	}
</script>