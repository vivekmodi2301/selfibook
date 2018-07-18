<?php
	if(isset($_SESSION['ulogin'])){
		$id=$_SESSION['ulogin']['id'];
		$detail=mysqli_fetch_assoc(mysqli_query($con,"select profile.id,name,gender,email,mobile,dob,state,city,relation,about,workat, secondaryschool,srsecschool,gcollege,pgcollege from profile join state on stateid=state.id join city on cityid=city.id where profile.id=$id"))
		?>
        	<div class="log">
	<div class="login">
    	Basic Profile Edit<br>
        <form method="post" action="index.php?mod=profile&do=edit">
        <table>
        <tr>
        	<td>Name</td><td><input type="text" name="name" value="<?php if(isset($detail['name'])){ echo $detail['name'];}?>"></td>
        </tr>
        <tr>
            <td>Gender</td><td><input type="radio" name="gender" value="male" <?php if($detail['gender']=='male'){?> checked<?php }?>>Male
            <input type="radio" name="gender" value="male" <?php if($detail['gender']=='female'){?> checked<?php }?>>Female</td>
        </tr>
        <tr>
        	<td>Email</td><td><input type="text" name="email" value="<?php if($detail['email']){echo $detail['email'];}?>">
        </tr>
        <tr>
            <td>Mobile</td><td><input type="text" name="mobile" value="<?php if($detail['mobile']){echo $detail['mobile'];}?>"</td>
        </tr>
        <tr>
            <td>Date of Birth</td><td><input type="text" name="dob" value="<?php if($detail['dob']){echo $detail['dob'];?>" readonly <?php }?>></td>
        </tr>
		<tr>
        	<td>State</td><td><input type="text" value="<?php if($detail['state']){ echo $detail['state'];?>" readonly<?php }?>></td>
        </tr>
        <tr>
        	<td>City</td><td><input type="text" value="<?php if($detail['city']){ echo $detail['city'];?>" readonly<?php }?>></td>
        </tr>
        <tr>
        	<td>Relation</td><td><input type="radio" name="relation" value="single" <?php if($detail['relation']){  if($detail['relation']=='single'){?> checked<?php }}?>>Single
            <input type="radio" name="relation" value="married" <?php if($detail['relation']){  if($detail['relation']=='married'){?> checked<?php }}?>>Married
            </td>
        </tr>
        <tr>
        	<td>About</td><td><textarea name="about" rows="10" cols="40" placeholder="Enter Something about You..."><?php if($detail['about']){ echo $detail['about'];}?></textarea></td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" value="Update"></td>
        </tr>
        </table>
        </form>
    </div>
    <div class="signin">
    	Educational and Professional Profile Edit
        <form method="post" action="index.php?mod=profile&do=edit">
        	<table>
            	<tr>
                	<td>Secondary School Name</td><td><input type="text" name="secondaryschool" value="<?php if($detail['secondaryschool']){echo $detail['secondaryschool'];}?>"></td>
                </tr>
                <tr>
                	<td>Senior Secondary School</td><td><input type="text" name="srsecschool" value="<?php if($detail['srsecschool']){echo $detail['srsecschool'];}?>"></td>
                </tr>
                <tr>
                	<td>Graduate College</td><td><input type="text" name="gcollege" value="<?php if($detail['gcollege']){echo $detail['gcollege'];}?>"></td>
                </tr>
                <tr>
                	<td>Postgraduate College</td><td><input type="text" name="pgcollege" value="<?php if($detail['pgcollege']){echo $detail['pgcollege'];}?>"></td>
                </tr>
                <tr>
                	<td>Work At</td><td><input type="text" name="workat" value="<?php if($detail['workat']){echo $detail['workat'];}?>"></td>
                </tr>
                <tr>
                	<td colspan="2"><input type="submit" value="submit"></td>
                </tr>
            </table>
        </form>
    </div>

</div>
        <?php	
	}
?>