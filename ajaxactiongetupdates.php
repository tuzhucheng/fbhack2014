<?

include("php/user.php");
include("php/room.php");
include ("php/mysql.php");
	
$userid = $_GET['userid'];
$post = $_GET['post'];

// Create MySQL Object
	
$mysql = new mysql("localhost", "hackathon2014", "root", "******");
$mysql->connect();

// Create a chat room object from SQL data
	
$room = new room($userid);
$post = str_replace("add","+",$post);


// id_expression returns true if the text is likely
// mathematical expression, false otherwise

function is_expression($str){
	$array = str_split($str);
	$allowed = array(' ','+','-','l','o','g','n','/','^','/','*','(',')','.','0','1','2','3','4','5','6','7','8','9','0');
	$allmatch = 1;
	foreach ($array as $key => $val) {
		$match = 0;
		foreach ($allowed as $kkey => $kval) {
			if ($kval == $val) {
				$match = 1;
			}
		}
		if ($match == 0) {
			$allmatch = 0;
		}
	}
	if ($allmatch == 0) return false;
	return true;
}

// Add new post to the database if applicable

if ($post != "") {
	$room->addpost($userid, $post);
	?>
	<input style="display:none"   id = "buffer" value="">
	<?
} else {
	$fetchedpost = $room->fetchnewpost($userid);
	$post = str_replace("[","\\(", str_replace("]","\\)",$fetchedpost[0]));
	$expression = str_replace(array("\\"," "), "", $post);
	if (is_expression($expression)) {
		$answer = " = ".shell_exec("expression.exe ".escapeshellarg("$expression"));
	}
	$answer .= "#NEWLINE".date('Y-m-d h:i:s A',strtotime($fetchedpost[1]));
?>
<input  style="display:none" id = "buffer" value="<? if (($post != "undefined") && ($post != "") )echo $post.$answer;?>">

<?}
?>

