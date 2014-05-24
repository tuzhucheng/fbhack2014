<?

// Class user is a user object that contains three fields
// userid, roomid which is the chatroom id the user is 
// registered in


class User{
	private $userid;
	private $roomid;
	private $name;

	// setuserid() sets the username
	
	public function setuserid($newuserid) {
		$userid = $newuserid;
	}
	
	// completeme() completes the userid, roomid information from
	// the userid
	
	public function completeme() {
		$userid = $this->$userid;
		$query	 		= sprintf("SELECT Name, Roomid FROM Users WHERE Userid like '$userid' ") or die("MySQL ERROR: ".mysql_error());
		$query_result 	= mysql_query($query);
		$row = mysql_fetch_array($query_result);
		$this->$name = $row['Name'];
		$this->$roomid = $row['Roomid'];
	}
		

}
?>