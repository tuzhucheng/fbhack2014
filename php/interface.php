<?


	// This module is a testing module to verify
	// that user, room, mysql objects work
	
	//include("user.php");
	//include("room.php");
	//include ("mysql.php");
	
	$userid = $_GET['userid'];
	echo "User: $userid";
	
	$mysql = new mysql("localhost", "hackathon2014", "root", "apmsetup");
	$mysql->connect();
	
	$room = new room($userid);
	echo $room->getroomid();
	
	//$room->addpost($userid, "HelloWorld");
	
	
?>