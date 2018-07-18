<?php 
	if(isset($_GET['uid'])){
		$uid=$_GET['uid'];
		?>
        <form method="post" enctype="multipart/form-data">
        	<table>
        		<tr><td><input type="file" name="name"></td></tr>
                <tr><td><textarea name="description"  rows="2" cols="50">Write Something About Photo...</textarea></td></tr>
                <tr><td><input type="hidden" name="uid" value="<?php echo $uid;?>"></td></tr>
                <tr><td><input type="submit" value="Submit"></td></tr>
            </table>
         </form>
        <?php
	}
?>
