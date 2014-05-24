<?
	// From frontpage.html ---------------------------------------
	$roomnumber	= $_POST['roomnumber'];
	$username	= $_POST['username'];
	
	// MYSQL CONNECT ---------------------------------------------
	
	$mysql_host 	= ; 
	$mysql_user 	= ;
	$mysql_password = ;
	
	// Wrong Username Bad Authentication
	if ($username != $outputusername) {
		header('Location: frontpage.html');
		exit;
	} 
	
	$room_key = sha1($username.$rand()."hackathonsalt");
	$temp_val_array = array($room_key, $userid, "", "", "", "open");
	INSERT("Table_Room",array("Roomid","Userid","User2","User3","User4","Status"), $temp_val_array);
	include("index.html");
?>