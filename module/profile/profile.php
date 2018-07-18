<?php
if(isset($_GET['frdreq'])){
		$frid=$_GET['frdreq'];
		$usid=$_GET['uid'];
		$sea=$_GET['search'];
		sendRequest($usid,$frid);	
		?>
        	<script>
				location.href="index.php?mod=friends&do=sentreq";
			</script>
        <?php
	}
	if(isset($_GET['deleid'])){
		$delid=$_GET['deleid'];
		$sea=$_GET['search'];
		deleteRequest($delid);
		?>
        	<script>
				location.href="index.php?mod=friends&do=friendreq";
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
				location.href="index.php?mod=friends&do=friends";
			</script>
        <?php
	}
if(!isset($_SESSION['ulogin'])){
	?>
    <script>
			location.href="module/userlogin/login.php";
		</script>

<?php } else{
	if(isset($_GET['id'])){
		$id=$_GET['id'];
	}
	else{
		$id=$_SESSION['ulogin']['id'];	
	}
	$detail=mysqli_fetch_assoc(mysqli_query($con,"select profile.id,profile.name as user , photos.name as photo ,gender,email,mobile,password,dob,stateid,cityid,relation,workat,secondaryschool,gcollege,pgcollege,about,propic, srsecschool, workat from profile left join photos on profile.propic=photos.id where profile.id=$id"));
	if($detail['propic']){
$photo=glob("upphotos/*.*");
if(in_array("upphotos/".$detail['photo'],$photo)){
	?>
	<img src="<?php echo UIMAGE.$detail['photo'];?>" width="70%" height="200px" style="margin-left:17%;margin-top:10px;">		
        <?php
}
else{
if($detail['gender']=='male'){?>
			<img src="<?php echo IMAGE;?>male.png" width="70%" height="200px" style="margin-left:17%;margin-top:10px;">
            
            <?php
		}	
		else{?>
			<img src="<?php echo IMAGE;?>female.png" width="70%" height="200px" style="margin-left:17%;margin-top:10px;">
            <?php
		}
	}
	}
	else{
		if($detail['gender']=='male'){?>
			<img src="<?php echo IMAGE;?>male.png" width="70%" height="200px" style="margin-left:17%;margin-top:10px;">
            
            <?php
		}	
		else{?>
			<img src="<?php echo IMAGE;?>female.png" width="70%" height="200px" style="margin-left:17%;margin-top:10px;">
            <?php
		}
	}
	?>
    <div class="submenu">
        	<ul style="background-color:#f8f8f8;">
            <?php
				if(isset($_GET['id']) && $_GET['id']!==$_SESSION['ulogin']['id']){
			?>
                    	<?php
							$uid=$_SESSION['ulogin']['id'];
							$fid=$_GET['id'];
							$rsa=mysqli_num_rows(mysqli_query($con,"select id,uid,fid from friends where uid=$uid and fid=$fid or uid=$fid and fid=$uid"));
                    	 if(!$rsa){
							$rsaa=mysqli_num_rows(mysqli_query($con,"select id,uid,fid from friendreq where uid=
$uid and fid=$fid"));
							if($rsaa){?>
								<li><?php echo "friend request send";?></li><?php			
							}else{
								$qry=mysqli_query($con,"select id,uid,fid from friendreq where uid=$fid and fid=$uid");
								$rsaaa=mysqli_fetch_assoc($qry);
								$friendid=mysqli_num_rows($qry);
								if($friendid){?>
									<li><a href="index.php?mod=profile&do=profile&userid=<?php echo $uid;?>&friendid=<?php echo $fid;?>&deleteid=<?php echo $rsaaa['id'];?>">Confirm Request</a><a href="index.php?mod=profile&do=profile&deleid=<?php echo $rsaaa['id'];?>">Delete Request</a></li>
                                    <?php
								}else{
								?>
								<li><a href="index.php?mod=profile&do=profile&frdreq=<?php echo $fid;?>&uid=<?php echo $uid;?>">Send Friend Request</a></li>
                                <?php	
								}
							}
						}
						else{?>
							<li><?php echo "Friends";?></li>
                            <?php	
						}
						 ?>
            <?php }?>
        	<li><a href="index.php?mod=page&do=profiletime">Timeline</a></li>
        	<li><a href="index.php?mod=profile&do=images&id=<?php echo $id;?>">Photos</a></li>
            <li><a href="index.php?mod=friends&do=friends&id=<?php echo $id;?>">Friends</a></li>
        </ul>
    </div>
		<div class="about">
        	<table  cellspacing="0px" border="0px" width="100%" class="profile">
            	<tr>
                	<th colspan="2" style="color:#909">Basic Detail</th>
                </tr>
                <?php if(!isset($_GET['id']) || ($_GET['id']==$_SESSION['ulogin']['id'])){?>
                <tr>
                	<td colspan="2" align="center"><a href="index.php?mod=profile&do=editprofile" style="font-size:18px;">Edit Profile</a></td>
                </tr>
                <!--<tr>
                	<td colspan="2" align="center"><a href="index.php?mod=profile&do=changepass&id=<?php echo $id;?>" style="font-size:18px;">Change Password</a></td>
                </tr>-->
                <?php }?>
                <tr>
                	<th width="50%">Basic Profile</td>
                    <th width="50%">Educational & Proffessional Profile</td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" class="bapro" style=" background-color:#f8f8f8; font-size:18px;">
                        	<tr>
                            	<th>User Name</th>
                                <td><?php echo strtoupper(strtolower($detail['user']));?></td>
                            </tr>
                            <tr>
                            	<th>Gender</th>
                                <td><?php echo strtoupper(strtolower($detail['gender']));?></td>
                            </tr>
                            <tr>
                            	<th>Email</th>
                                <td><?php echo $detail['email'];?></td>
                            </tr>
                            <tr>
                            	<th>Mobile</th>
                            	<td><?php if($detail['mobile']){echo $detail['mobile'];} else{ echo "No mobile no. yet";}?></td>
                            </tr>
                            <tr>
                            	<th>Date Of Birth</th>
                                <td><?php echo $detail['dob'];?></td>
                            </tr>
                            <tr>
                            	<th>State</th>
                                <td>
                                <?php
                                	if($detail['stateid']){
										$ste=$detail['stateid'];
										$id=$_SESSION['ulogin']['id'];
										$state=mysqli_fetch_assoc(mysqli_query($con,"SELECT stateid, state FROM profile JOIN state ON stateid = state.id WHERE stateid =$ste and profile.id=$id"));
										echo $state['state'];
									}
								?>
   								</td>
                            </tr>
                            <tr>
                            	<th>City</th>
                                <td>
                                <?php
                                	if($detail['cityid']){
										$cit=$detail['cityid'];
										$id=$_SESSION['ulogin']['id'];
										$city=mysqli_fetch_assoc(mysqli_query($con,"SELECT cityid, city FROM profile JOIN city ON cityid = city.id WHERE cityid =$cit and profile.id=$id"));
										echo $city['city'];
									}
								?>
   								</td>
                            </tr>
                            <tr>
                            	<th>About You</th>
                                <td><?php if($detail['about']){echo $detail['about'];}else{if($_GET['id']){echo "-";}else{ echo "Write Something about You";}}?></td>
                            </tr>
                        </table>
                    </td>
                	<td style="background-color:#f8f8f8;">
                    	<table width="100%" class="edupro" style="background-color:#f8f8f8; font-size:18px;" height="100%">
                        	<tr>
                            	<th>Secondary School Name</th>
                                <td><?php if($detail['secondaryschool']){ echo $detail['secondaryschool'];} else{  if($_GET['id']){echo "-";}else{echo "Enter your school name";}}?></td>
                            </tr>
                            <tr>
                            	<th>Senior Secondary School Name</th>
                                <td><?php if($detail['srsecschool']){ echo $detail['srsecschool'];} else{ if($_GET['id']){echo "-";}else{ echo "Enter your Sr. Sec. School Name";}}?></td>
                            </tr>
                            <tr>
                            	<th>Graduate College Name</th>
                                <td><?php if($detail['gcollege']){ echo $detail['gcollege'];} else{ if($_GET['id']){echo "-";}else{echo "Enter your Graduate College Name";}}?></td>
                            </tr>
                            <tr >
                            	<th>Post Graduate College Name</th>
                                <td><?php if($detail['pgcollege']){ echo $detail['pgcollege'];} else{if($_GET['id']){echo "-";}else{ echo "Enter your Post Graduate College Name";}}?></td>
                            </tr>
                            <tr>
                            	<th>Work At</th>
                                <td><?php if($detail['workat']){ echo $detail['workat'];} else{if($_GET['id']){echo "-";}else{ echo "Enter your Office Name or Bussiness Name";}}?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        
	<?php
}
	?>