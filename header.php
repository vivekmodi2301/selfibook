<html>
	<head>
    	<title>SelfiBook</title>
        <link rel="stylesheet" href="<?php echo CSS;?>style.css">
    </head>
    <body>
        <table class="main" cellspacing="0px">
            <tr class="header">
                <td width="18%"><img src="image/title.png"></td>
                <td width="55%">
                	<ul>
                    <?php if(!isset($_SESSION['ulogin'])){?>
                    	<li><a href="index.php?mod=userlogin&do=login">Login</a></li>
                        <?php }
						else{
							?>
                            <li><a href="index.php?mod=page&do=timeline">Home</a></li>
                            <li><a href="index.php?mod=profile&do=profile">Profile</a></li>
                            <li><a href="index.php?mod=friends&do=friendreq">Friends Request</a></li>
                            <li><a href="index.php?mod=userlogin&do=logout">Logout</a></li>
                            <?php
						}
						?>
                        <?php if(isset($_SESSION['ulogin'])){
							$id=$_SESSION['ulogin']['id'];
							$rs=mysqli_fetch_assoc(mysqli_query($con,"select profile.propic as pid,profile.id,photos.name as propic , gender from profile left join photos on profile.propic=photos.id where profile.id=$id"));
							if($rs['propic']){
								?>
                                <a href="index.php?mod=photo&do=show&pid=<?php echo $rs['pid'];?>"><img src="<?php echo UIMAGE.$rs['propic'];?>" height="30px" width="30px"></a>
                                <?php	
							}
							else{?>
								<img src="<?php echo IMAGE.$rs['gender']."."."png";?>" height="30px" width="30px">
                                <?php
							}echo $_SESSION['ulogin']['email']; 
						}
						?>
                    </ul>
                </td>
                <?php
				if(isset($_SESSION['ulogin'])){?>
                                <td>
                <form id="searchbox" method="post" action="index.php?mod=profile&do=search">
    <input id="search" type="text" name="search" placeholder="Type here">
    <input id="submit" type="submit" value="Search">
</form>
                </td>
                <?php }?>
               
            </tr>
            <tr class="middle" >
                <td colspan="3" valign="top">
                