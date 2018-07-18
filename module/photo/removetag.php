<?php
if(isset($_GET['tagid'])){
	$tagid=$_GET['tagid'];
	$pid=$_GET['pid'];
	delete('tag',$tagid);
	?>
    	<script>
			location.href="index.php?mod=photo&do=removetag&pid=<?php echo $pid;?>";
		</script>	
    <?php	
}
if(isset($_GET['pid'])){
	$uid=$_SESSION['ulogin']['id'];
	$pid=$_GET['pid'];
	$photo=mysqli_fetch_assoc(mysqli_query($con,"select id, name from photos where id=$pid"));			
	?>
    <form method="post">
    	<table class="photoshow" cellspacing="5px" border="0px" style="padding:10px 5px 10px 5px;">
        	<tr>
            	<td colspan="2"><img src="<?php echo UIMAGE.$photo['name'];?>" height="300px" width="500px"></td>
            </tr>
            <?php
				$rs=mysqli_query($con,"select tag.id,profile.name,pid from tag join profile on fid=profile.id where pid=$pid");
				while($tfir=mysqli_fetch_assoc($rs)){
					?>
                    	<tr>
                        	<td><?php echo $tfir['name'];?></td>
                            <td><input type="button" style="width:100px;align:right;"  onClick="removetag(<?php echo $tfir['id'];?>)" value="Remove Tag"></td>
                        </tr>
                    <?php	
				}
			?>
            <tr>
            	<td colspan="2"><input type="button" value="Done" onClick="location.href='index.php?mod=photo&do=show&pid=<?php echo $pid;?>'"></td>
            </tr>
<?php }?>
</table>
<script>
	function removetag(tagid){
		if(confirm("Do You Really Want to Remove Tag")){
			location.href="index.php?mod=photo&do=removetag&tagid="+tagid+"&pid=<?php echo $pid;?>";
		}	
	}
</script>