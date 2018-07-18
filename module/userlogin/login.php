<?php
	if(!isset($_SESSION['ulogin'])){
	if(isset($_GET['err'])){
		echo $_GET['err'];
	}
?>
<div class="log">
	<div class="login">
    	Already A Member Login Here<br>
        <form method="post" action="index.php?mod=userlogin&do=log">
        <table>
        <tr>
        	<td>Username</td><td><input type="text" name="username" placeholder="123@gmail.com"></td>
        </tr>
        <tr>
            <td>Password</td><td><input type="password" name="password" id="pass" placeholder="Enter Your Password"></td>
        </tr>
        <tr>
        	<div class="showpass" ><td colspan="2"><input type="checkbox" onChange="showpass(document.getElementById('pass').type)">Show Password</td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="LogIn!"></td>
        </tr>
        </table>
        </form>
    </div>
    <div class="signin">
    	New User Sign In!
        <form method="post" action="module/userlogin/signin.php">
        	<table>
            	<tr>
                	<td>Name</td><td><input type="text" id="name" name="name" placeholder="Enter Your Full Name"></td></tr>
                    <td>Gender</td><td><input type="radio" id="gender" name="gender" value="male">Male
                    <input type="radio" name="gender" value="female">Female
                    </td>
                </tr>
                <tr>
                	<td>Email as username</td><td><input type="email" id="mail" name="email" placeholder="Enter your Email address as username" onChange="validuser(this.value)"><div id="user"></div></td>
                </tr>
                <tr>
                	<td>Password</td><td><input type="password" id="password" name="password" placeholder="Enter Your Password"> </td>
           		</tr>
                <tr>
                	<td>Your Date Of Birth</td>
                    <td>
                    	<select name="dob[]">
                        <option value="">year</option>
                    	<?php 
							for($i=1950;$i<=2016;$i++){
								?>
                                	<option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php	
							}
						?>
                        </select>
                        <select name="dob[]">
                        	<option value="">Month</option>
								<?php
                                    for($i=1;$i<=12;$i++){
                                        ?>
                                        <option <?php if($i==2000){?> selected<?php }?> value="<?php if($i<10){echo '0'.$i;} else{ echo $i;	}?>"><?php echo $i;?></option>	
                                        <?php
                                    }
                                ?>
                        </select>
                        <select name="dob[]">
                        	<option value="">Date</option>
                            <?php
								for($i=1;$i<=31;$i++){
									?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                  	<?php		
								}
							?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>State & City</td>
                    <td>
                    	<select id="state" name="stateid" onChange="cit(this.value)">
                        	<option value="">Select State</option>
                            <?php
								$rs=mysqli_query($con,"select id,state from state");
								while($state=mysqli_fetch_assoc($rs)){
								?>
                                <option value="<?php echo $state['id'];?>"><?php echo $state['state'];?></option> 
                                <?php	
								}
							?>
                        </select>
                        <select id="city" name="cityid" >
                        	<option value="">Select City</option>
                    </td>
                </tr>
                <tr>
                	<td colspan="2"><input type="submit" value="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php }
?>
<script src="js/jquery.js.js"></script>
<script>
	function showpass(type){
		if(type=='password'){
			document.getElementById('pass').type='text';	
		}	
		else{
			document.getElementById('pass').type='password';
		}
	}
	function cit(state){
		$.ajax({
			url:"module/userlogin/city.php",
			data:"state="+state,
			type:'GET',
			success: function(data){$('#city').html(data);}
		});	
	}
	function validuser(email){
		$.ajax({
			url:"module/userlogin/validuser.php",
			data:"email="+email,
			type:'GET',
			success: function(data){$('#user').html(data);},
			error:function(e){alert("page nahi aa raha proper.");}
		});	
	}
</script>