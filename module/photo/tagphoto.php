<?php
if(isset($_POST['fid']) && $_POST['fid']){
	$fid=array();
	if(is_array($_POST['fid'])){
		$row=count($_POST['fid']);
		for($i=0;$i<$row;$i++){
			$fid['fid']=$_POST['fid'][$i];
			$fid['pid']=$_GET['pid'];
			addEdit('tag',$fid);
		}
			?>
            	<script>
					location.href="index.php?mod=photo&do=show&pid=<?php echo $_GET['pid'];?>"
				</script>
            <?php	
	}	
}
if(isset($_GET['pid'])){
	$uid=$_SESSION['ulogin']['id'];
	$pid=$_GET['pid'];
	$photo=mysqli_fetch_assoc(mysqli_query($con,"select id, name from photos where id=$pid"));			
	?>
    <form method="post">
    	<table class="photoshow" cellspacing="5px" style="padding:10px 5px 10px 5px;">
        	<tr>
            	<td colspan="3"><img src="<?php echo UIMAGE.$photo['name'];?>" height="300px" width="500px"></td>
            </tr>
            <?php
				$rs=mysqli_query($con,"select id,fid,uid from friends where uid=$uid or fid=$uid");
				$i=1;
				
				?>
                <tr>
                	<td colspan="3"><h1>Tag Your Friends</h1></td>
                </tr>
                	<tr><?php
                    while($profile=mysqli_fetch_assoc($rs)){
						if($profile['fid']==$uid){
							$friendid=$profile['uid'];	
						}
						else{
							$friendid=$profile['fid'];
						}
						$friends=mysqli_fetch_assoc(mysqli_query($con,"select id,name from profile where id=$friendid"));
						if($i==4){?>
                            </tr>
                            <tr>
                            <?php $i=1; }?>
                    	<td>
                        <input type="checkbox" <?php if(mysqli_num_rows(mysqli_query($con,"select tag.id,tag.fid from photos right join tag on tag.fid=photos.id where tag.fid=$friends[id] and tag.pid=$pid "))){?>checked disabled<?php }?> name="fid[]" value="<?php echo $friends['id'];?>"><?php echo ucwords(strtolower($friends['name'])); ?>
                        </td>
                        <?php $i++; }?>
                    </tr>
                    <tr>
                    	<td colspan="3" align="center"><input type="submit" style="width:400px;" value="Tag!!"></td>
                    </tr>
        </table>	
        </form>
    <?php
}?>

