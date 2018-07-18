<html>
	<head>
    	<title>SelfiBook</title>
        <link rel="stylesheet" href="<?php echo CSS;?>style.css">
    </head>
    <body>
        <table class="main" cellspacing="0px">
            <tr class="header">
                <td width="25%"><img src="<?php echo IMAGE;?>title.png"></td>
                <td width="40.33%">
                	<ul>
                    <?php if(!isset($_SESSION['ulogin'])){?>
                    	<li><a href="index.php?mod=userlogin&do=login">Login</a></li>
                        <?php }
						else{
							?>
                            <li><a href="index.php?mod=profile&do=profile">Profile</a></li>
                            <li><a href="index.php?mod=profile&do=images">Photos</a></li>
                            <li><a href="index.php?mod=userlogin&do=logout">Logout</a></li>
                            <?php
						}
						?>
                        <?php if(isset($_SESSION['ulogin'])){
							$id=$_SESSION['ulogin']['id'];
							$rs=mysqli_fetch_assoc(mysqli_query($con,"select id,propic,gender from profile where id=$id"));
							if($rs['propic']){
								?>
                                <img src="image/<?php echo $rs['propic'];?>" height="30px" width="30px">
                                <?php	
							}
							else{
								if($rs['gender']=='male'){
									?>
                                    <img src="<?php echo IMAGE;?>male.png" height="30px" width="30px">
                                    <?php	
								}	
								else{
									?>
                              		<img src="<?php echo IMAGE;?>female.png"  height="30px" width="30px">	
                                    <?php
								}
							}echo $_SESSION['ulogin']['email']; 
						}
						?>
                    </ul>
                </td>
            </tr>
            <tr class="middle" >
                <td colspan="2" valign="top">
                