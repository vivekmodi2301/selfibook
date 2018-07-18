<?php
if(isset($_SESSION['ulogin']['id'])){
	if(isset($_GET['id'])){
		if($_GET['id']==$_SESSION['ulogin']['id']){?>
<div class="button">
	<input type="button" value="+Add New Photos" onClick="addphoto(<?php echo $_SESSION['ulogin']['id'];?>)">
</div>
<?php }
	}
	else{
		?>
<div class="button">
	<input type="button" value="+Add New Photos" onClick="addphoto(<?php echo $_SESSION['ulogin']['id'];?>)">
</div>
		<?php
	}
}
if(isset($_POST['description'])){	
		$_POST['name']=time()._.$_FILES['name']['name'];
		move_uploaded_file($_FILES['name']['tmp_name'],'upphotos/'.$_POST['name']);
		addEdit('photos',$_POST);
		?>
        <script>
			location.href="index.php?mod=profile&do=images&id=<?php echo $_POST['uid'];?>";
		</script>
        <?php
	}
?>
<div id="photos"></div>
<div class="image">
	<?php
		if(isset($_SESSION['ulogin'])){
			if(isset($_GET['id'])){
				$id=$_GET['id'];
			}else{
			$id=$_SESSION['ulogin']['id'];
			}
			$rs=mysqli_query($con,"select id,name from photos where uid=$id");
			$i=1;
			?>
            <table cellspacing="20px">
            	<tr>
                <?php
				if(mysqli_num_rows($rs)){
			while($photo=mysqli_fetch_assoc($rs)){
				if($i==7){
					?>
                    </tr>
                    <tr>
                    <?php
					$i=1;
				}
				$i++;
				?>
                	<td><a href="index.php?mod=photo&do=show&pid=<?php echo $photo['id'];?>"><img src="<?php echo UIMAGE.$photo['name'];?>" height="200px" width="200px"></a></td>
                <?php
			}
			?>
            </tr>
			</table>
            <?php
		}
		else{
			echo "No photos uploded till now";	
		}
		}
	?>
</div>
<script src="js/jquery.js.js"></script>
<script>
	function addphoto(id){
		$.ajax({
		url:"module/profile/addphotos.php",
		data:"uid="+id,
		type:'GET',
		success: function(data){$('#photos').html(data);},
		error:function(e){alert("page nahi aa raha proper.");}
		});	
	}
</script>