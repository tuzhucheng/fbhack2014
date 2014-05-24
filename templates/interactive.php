<?

	include("class/user.php");
	include("class/room.php");
	include ("class/mysql.php");
	include("../../FUNCTIONS/classical_functions.php");
	include("../../FUNCTIONS/php2js_function.php");
	
?>
<html ng-app>
    <head>
    	<title>Facebook Hackthon</title>
		<script src="JS/jquery-2.1.0.min.js"></script>
		<script src="JS/jquery-ui.js"></script>
		<script src="JS/jquery.flippy.js"></script>
        <script src="JS/MetroJs.lt.min.js"></script>
		<script>
		
		setInterval(function(){
			ajaxFunctionupdate('1');
			if ($("#buffer").val()	!= '') {
				$( "#wrapper" ).append( "<div id = 'predynamic'>SEE CHANGE</div> " );
				$('#dynamic').attr('id','static');
				$('#predynamic').text($("#buffer").val());
				$('#predynamic').attr('id','dynamic');
				$("#buffer").val("");
			}
		},1500);
		
		$(document).on({
			change: function () { 
				//alert("Whatsup");
				$( "#wrapper" ).append( "<div id = 'predynamic'>SEE CHANGE</div> " );
				$('#dynamic').attr('id','static');
				$('#predynamic').attr('id','dynamic');
				},	
		},'#switch');
		</script>
		<?
		ajaxhandler('ajaxactiongetupdates.php','ajaxFunctionupdate','ajaxRequester',array('userid'),'ajaxdropzone');
		?>
		
	</head>
	
<?
		
	$userid = $_GET['userid'];
	echo "User: $userid";
	
	$mysql = new mysql("localhost", "hackathon2014", "root", "apmsetup");
	$mysql->connect();
	
	$room = new room($userid);
	echo $room->getroomid();
	
	//$room->addpost($userid, "HelloWorld");
		
?>
<div id="ajaxdropzone">
	<input id = "buffer" value="">
</div>

<div id = "wrapper">
	<div id = "dynamic">SEE CHANGE</div> 
</div>