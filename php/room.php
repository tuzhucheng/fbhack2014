<?

// Room object contains two fields, room_id, as unique chatroom id, and last_post
// a string containing the latest post. last_post will appear on the screen if the user
// has not read it before



class room {

	private $room_id;
	private $last_post;
	
	public function __construct($userid) {
		$query	 		= sprintf("SELECT RoomId FROM Users WHERE UserId like '$userid'") or die("MySQL ERROR: ".mysql_error());
		$query_result 	= mysql_query($query);
		$row = mysql_fetch_array($query_result) or die("MySQL ERROR: ".mysql_error());
		$this->room_id = $row['RoomId'];
	}
	
	public function getroomid() {
		echo "$room_id!!!<br>";
		return $this->room_id;
	}
	
	// addpost($userid, $post) the room object adds post from the user to the database
	
	public function addpost($userid, $post) {
		mysql_query("INSERT INTO Posts (UserId,RoomId,Timestamp,Post) VALUES ('$userid','$this->room_id','". date("Y-m-d H:i:s")."','$post')")
			or  die("MySQL ERROR: ".mysql_error());
	}

	// fetchnewpost($userid) searches and returns the latest posts that have not been read
	// already in array form
	
	public function fetchnewpost($userid){
		
		$query	 		= sprintf("SELECT Post,Timestamp,UserId FROM Posts WHERE RoomId like '".$this->room_id."' and UserId NOT like '$userid' and `Read` NOT like '1' ORDER by Timestamp DESC") ;
		$query_result 	= mysql_query($query);
		$row = mysql_fetch_array($query_result); //die("MySQL ERROR: ".mysql_error());
		
		$query	 		= sprintf("UPDATE Posts SET `Read`=1 WHERE RoomId like '".$this->room_id."' and UserId NOT like '$userid'") ;
		mysql_query($query) or die("MySQL ERROR: ".mysql_error());
		if (($row['UserId'] != $username) && ($row['Post'] != $last_post)) {
			return array($row['Post'],$row['Timestamp']);
		}
	}
}