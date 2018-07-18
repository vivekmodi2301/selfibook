<?php
	if(isset($_GET['dislikeid'])){
		$did=$_GET['dislikeid'];
		$timephoto['id']=$_GET['dispicid'];
		mysqli_query($con,"delete from likes where id=$did");
		?>
        	<script>
				location.href="index.php?mod=photo&do=show&pid=<?php echo $timephoto['id'];?>"
			</script>
        <?php
	}
	if(isset($_GET['likephoto'])){
		$timephoto['id']=$_GET['likephoto'];
		$_POST['pid']=$timephoto['id'];
		$_POST['uid']=$_SESSION['ulogin']['id'];
		addEdit('likes',$_POST);?>
		<script>
			location.href="index.php?mod=photo&do=show&pid=<?php echo $timephoto['id'];?>";
		</script>
        <?php
	}
	$uid=$_SESSION['ulogin']['id'];
	$friend=array();
	$id=$_SESSION['ulogin']['id'];
	$timephoto=mysqli_query($con,"select uid, fid from friends where uid=$id or fid=$id");
	if(!mysqli_num_rows($timephoto)){
		echo "Please Make Friends to see thier photos ";
	}
	else{
		while($friends=mysqli_fetch_assoc($timephoto)){
			if($friends['uid']==$id){
				$friend[]=$friends['fid'];
			}
			else{
				$friend[]=$friends['uid'];
			}
		}
		$tfriend=count($friend);
		$wh="where 1 and uid=$id or ";
		for($i=0;$i<$tfriend;$i++){
			$wh.=" uid=$friend[$i] or tag.fid=$friend[$i] or ";	
		}
		$wh=substr($wh,0,-3);
		$url="index.php?mod=page&do=timeline";
		$limit=1;
	$frmdataget=$_REQUEST;
		PaginationWork();
$totRslt=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as tot from photos left join tag on pid=photos.id left join profile on uid=profile.id $wh"));
		$query=mysqli_query($con,"select photos.id, profile.name as user,photos.uid,profile.propic,profile.gender, photos.name, time, description from photos left join tag on pid=photos.id left join profile on uid=profile.id $wh group by photos.id order by photos.time desc limit ".$frmdata['from'].", ".$frmdata['to']);
		$i=1;
			while($timephoto=mysqli_fetch_assoc($query)){
			?>
            	<div class="photoshow">
            		<table width="100%" border="0px" cellspacing="5px" style="padding:5px 10px 5px 10px; margin-top:50px; margin-bottom:20px;">
                    	<tr>
                        	<td width="40%"  colspan="3" rowspan="15"><a href="index.php?mod=photo&do=show&pid=<?php echo $timephoto['id'];?>"><img src="upphotos/<?php echo $timephoto['name'];?>" height="300px" width="500px"></td>
                            <?php 
                            if($timephoto['description']!=="Write Something About Photo..."){?>
            <tr>
            	<td colspan="3" style="padding:10px 5px 10px 5px; text-align:center;"><?php echo $timephoto['description'];?></td>
            </tr>
            <?php }?>
                            <tr>
            	<td style="padding:10px 0px 20px 10px;" width="15%" rowspan="3"><img src="<?php if(!$timephoto['propic']){ echo IMAGE.$timephoto['gender'].".".png; } else{ 
				$propic=mysqli_fetch_assoc(mysqli_query($con,"select id,name,uid from photos where id=$timephoto[propic]"));
				echo UIMAGE.$propic['name'];} ?>" height="40px" width="50px"></td>
                <td colspan="2"><a href="index.php?mod=profile&do=profile&id=<?php echo $propic['uid'];?>"><?php echo ucfirst($timephoto['user']);?></a></td>
            </tr>
            <tr>
            	<td colspan="2">
					<?php $date=strpos($timephoto['time'],' ');
					echo substr($timephoto['time'],0,$date);
					?>
                </td>
            </tr>
            <tr>
            	<td colspan="2">
                	<?php $time=strpos($timephoto['time'],' ');
					echo substr($timephoto['time'],$time);
					?>
                </td>
            </tr>
                <tr>
            	<td colspan="2">
                	Friends Taged
                    <?php
						$data=mysqli_query($con,"select profile.id, profile.name as user, photos.name from tag join profile on fid=profile.id join photos on pid=photos.id where pid=$timephoto[id]");
						$i=1;
						while($tfriend=mysqli_fetch_assoc($data)){
							if($i==7){
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
                <?php $rss=mysqli_query($con,"select id,uid,pid from likes where uid=$uid and pid=$timephoto[id]"); if(mysqli_num_rows($rss)){$likes=mysqli_fetch_assoc($rss)?> <a href="index.php?mod=photo&do=show&dislikeid=<?php echo $likes['id'];?>&dispicid=<?php echo $likes['pid'];?>">Dislike photo</a><?php }else{ ?>
                <a href="index.php?mod=photo&do=show&likephoto=<?php echo $timephoto['id'];?>">Like Photo</a><?php } if($timephoto['uid']==$_SESSION['ulogin']['id']){?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?mod=photo&do=propic&propic=<?php echo $timephoto['id'];?>">Make Profile Picture</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="deletepic(<?php echo $timephoto['id'];?>)">Delete Picture</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?mod=photo&do=tagphoto&pid=<?php echo $timephoto['id'];?>">Tag Photo</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?mod=photo&do=removetag&pid=<?php echo $timephoto['id'];?>">Remove Tag</a><?php }?></td>
            </tr>
            <tr>
            	<td colspan="2"><?php if($pepole=mysqli_num_rows(mysqli_query($con,"select id,uid,pid from likes where pid=$timephoto[id]"))){echo $pepole;?> <a href="index.php?mod=photo&do=likes&pid=<?php echo $timephoto['id'];?>">Pepole</a><?php } else{?>0 Pepole<?php }?> Like this</td>
            </tr><?php
			$fid=$timephoto['uid'];
			 if(mysqli_num_rows(mysqli_query($con,"select id,uid,fid from friends where uid=$uid and fid=$fid or uid=$fid and fid=$uid")) || $uid==$fid){ ?>
            <tr>
            	<td colspan="2" align="center" style="padding-top:10px;padding-bottom:10px;"><form action="index.php?mod=photo&do=show&pid=<?php echo $timephoto['id'];?>"  method="post"><textarea name="comment" row="2" cols="50"></textarea><input type="submit" value="Submit"></form></td>
            </tr>
					<?php
			}
                		$rss=mysqli_query($con,"select comments.id,comments.pid, comments.uid, profile.name as friend,comment,comments.time from comments join profile on uid=profile.id join photos on pid=photos.id where pid=$timephoto[id] order by comments.id asc");
						$j=1;
						while($comments=mysqli_fetch_assoc($rss)){
					?>
            <tr>
            	<td colspan="2">
                <table border="0px" cellspacing="5px" style="width:500px; padding-left:20px; margin-top:10px;">
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
                	<td><a href="#" onClick="deleteComment(<?php echo $comments['id'];?>,<?php echo $comments['pid'];?>)">Delete Comment</td>
                </tr>
                <?php }?>
                </table>
                </td>
            </tr>
            <?php
						$j++;if($j>2){
							?><tr><td><a href="index.php?mod=photo&do=show&pid=<?php echo $timephoto['id'];?>">View all Comments</a></td></tr><?php break;
							}}
						
			?>
                    </table>
                </div>
            <?php	
			}?>
            <div align="center">
            <?php PaginationDisplay($totRslt['tot'],$url.'&pageNumber=','','','View More Photos');?>
            </div>
	<?php }?>
<script>
	function deletepic(picid){
		if(confirm("Do you really want to Delete photo")){
			location.href="index.php?mod=photo&do=deletepic&deletepic="+picid;	
		}
	}
	function deleteComment(comid,pid){
		if(confirm("Do you really want to Delete Comment")){
			location.href="index.php?mod=photo&do=show&dcomid="+comid+"&picid="+pid;
		}
	}
</script>