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
	function delete($table,$id){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="delete from $table where id=$id";
		mysqli_query($con,$qry);	
	}
	function sendRequest($uid,$fid){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="insert into friendreq set uid=$uid,fid=$fid";
		mysqli_query($con,$qry);
	}
	function deleteRequest($id){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="delete from friendreq where id=$id";
		mysqli_query($con,$qry);
	}
	function acceptRequest($uid,$fid,$id){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="delete from friendreq where id=$id";
		mysqli_query($con,$qry);
		$qry="insert into friends set uid=$uid,fid=$fid";
		mysqli_query($con,$qry);
	}
	function unfriend($uid,$fid){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="delete from friends where uid=$uid and fid=$fid or uid=$fid and fid=$uid";
		mysqli_query($con,$qry);
	}
	function cancelReq($reqid){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="delete from friendreq where id=$reqid";
		mysqli_query($con,$qry);
	}
	function dComment($id){
		$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DB);
		$qry="delete from comments where id=$id";
		mysqli_query($con,$qry);
	}
	
	
	function PaginationWork($pno='')
{
   global $frmdata ;
   global $frmdataget;
    $recordPerPage=2;
   if($pno)
     $recordPerPage=$pno;
   
   $frmdata['to']=$recordPerPage;
   if($frmdataget['pageNumber']<=1)
   {
	   $frmdataget['pageNumber']=1;
       $frmdata['from']=0;
     }
   else
        $frmdata['from']= $recordPerPage * ( ( (int) $frmdataget['pageNumber']) - 1);
  
}
function PaginationDisplay(&$totalCount,$starturl,$endurl,$pno='',$view='')
{
        global $frmdata;
        global $frmdataget;
		$recordPerPage=2;
		if($pno)
		 $recordPerPage=$pno;
        
		if($totalCount > $recordPerPage)
        {
            echo '<span id="pg">';
            $pre=$frmdataget['pageNumber']-1;
            $i=1;
            $j=$frmdataget['pageNumber'];
            if($j>=2)
            $i=$j-4;
            $frmdataget['pageNumber']=$j;
            $next=$frmdataget['pageNumber']+1;
if(!$view){
   $view=">Next";
}
            if($totalCount > ($frmdata['from'] + $frmdata['to']))
            {
                echo '<a href="'.$starturl.$next.$endurl.'" >&gt;'.$view.'</a>';
            }
            echo '</span>';
      }
}
?>
