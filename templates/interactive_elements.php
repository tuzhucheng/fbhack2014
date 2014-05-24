<html ng-app>
    <head>
    	<title>Facebook Hackthon</title>
		<script src="JS/jquery-2.1.0.min.js"></script>
		<script src="JS/jquery-ui.js"></script>
		<script src="JS/jquery.flippy.js"></script>
        <script src="JS/MetroJs.lt.min.js"></script>
		<script>
		$(document).on({
			click: function () { 
				//alert("Whatsup");
				$( "#wrapper" ).append( "<div id = 'predynamic'>SEE CHANGE</div> " );
				$('#dynamic').attr('id','static');
				$('#predynamic').attr('id','dynamic');
				},	
		},'#bubble');
		</script>
	</head>
	
<?
	
	include("class/user.php");
	include("class/room.php");
	include ("class/mysql.php");
	
	$userid = $_GET['userid'];
	echo "User: $userid";
	
	$mysql = new mysql("localhost", "hackathon2014", "root", "apmsetup");
	$mysql->connect();
	
	$room = new room($userid);
	echo $room->getroomid();
	$room->addpost($userid, "HelloWorld");
		
?>
<div id = "wrapper">
	<div id = "bubble" >CLICK HERE</div>
	<div id = "dynamic">SEE CHANGE</div> 
</div>