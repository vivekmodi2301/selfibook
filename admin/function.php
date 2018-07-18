<?php
	$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
	function addEdit($table,$data,$id=""){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="insert into $table set ";
		$wh="";
		if($id){
			$qry="update $table set ";
			$wh="where id=$id";	
		}	
		foreach($data as $key=>$value){
			$qry.="$key='$value' ,";	
		}
		$qry=substr($qry,0,-1).$wh;
		mysqli_query($con,$qry);
	}
?>