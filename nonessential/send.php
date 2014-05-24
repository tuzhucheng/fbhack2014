<?
	// From index.php ---------------------------------------
	$username	= $_POST['username'];
	$roomid 	= $_POST['roomid'];
	$usertype 	= $_POST['usertype']; //1,2,3 or 4
	//-------------------------------------------------------
	
	include('mysql_commands.php');
	
	INSERT("User",array("Roomid","usertype","ReadbyUser1","ReadbyUser2","ReadbyUser3","ReadbyUser4"), $temp_val_array);
	
	
?>