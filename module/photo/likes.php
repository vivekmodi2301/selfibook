<?php
if(isset($_GET['pid'])){
	$pid=$_GET['pid'];
	$photo=mysqli_fetch_assoc(mysqli_query($con,"select id, name from photos where id=$pid"));			
	?>
    	<table class="photoshow" cellspacing="5px" style="padding:10px 5px 10px 5px;">
        	<tr>
            	<td colspan="3"><img src="<?php echo UIMAGE.$photo['name'];?>" height="300px" width="500px"></td>
            </tr>
            <?php
				$rs=mysqli_query($con,"select profile.id, profile.name from likes join profile on uid=profile.id where pid=$pid");
				$i=1;
				
				?>
                <tr>
                	<td colspan="3"><h1>Pepole Who like This photo</h1></td>
                </tr>
                	<tr><?php
                    while($profile=mysqli_fetch_assoc($rs)){
						if($i==4){?>
                            </tr>
                            <tr>
                            <?php }?>
                    	<td><a href="index.php?mod=profile&do=profile&id=<?php echo $profile['id'];?>"><?php echo ucwords(strtolower($profile['name']));?></td>
                        <?php $i++; }?>
                    </tr>
        </table>	
    <?php
}
?>