<html ng-app>
    <head>
    	<title>Facebook Hackthon</title>
		<!--------------------------- Javascript and JQUERY ------------------------------->
		<script src="JS/jquery-2.1.0.min.js"></script>
		<script src="JS/jquery-ui.js"></script>
		<script src="JS/jquery.flippy.js"></script>
        <script src="JS/MetroJs.lt.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.9/angular.min.js"></script>		
		<script type="text/x-mathjax-config">
		  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
		</script>
		<script type="text/javascript"
		  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
		</script>
		<link rel="stylesheet" type="text/css" href="CSS/MetroJs.lt.min.css">
		<link rel="stylesheet" href="CSS/jquery-ui-smooth.css" />
        <link rel="stylesheet" href="CSS/main.css" />
		<!--------------------------------CSS---------------------------------------------->
		<? 
			include('../../FUNCTIONS/classical_functions.php'); 
			include("../../FUNCTIONS/php2js_function.php");
			ajaxhandler('ajaxactiongetupdates.php','ajaxFunctionupdate','ajaxRequester',array('userid','post'),'ajaxdropzone');
			ajaxhandler('ajaxtextarea.php','ajaxTextAreaReset','ajaxRequester',array(''),'ajaxtextareareset');
		?>
		<script>
		
		// LIVE SUBMISSION OF TEXT
		
		// call ajaxFunctionupdate upon submit event
		
		$(document).on({
			submit: function () { 
				//alert($("#inputbox").val());
				var str = $("#inputbox").val();
				str = str.split("+").join("add");
				//alert(str);
				ajaxFunctionupdate(<? echo $_GET['userid']?>,str);
				ajaxTextAreaReset();				
				},	
		},'#textform');
		
		// GET INSTANT UPDATES
		
		// listen for new messages using setInterval
		
		setInterval(function(){
			ajaxFunctionupdate(<? echo $_GET['userid']?>,'');
			document.getElementById('inputbox').focus();
			//alert("qqq");
			if ($("#buffer").val()	!= '') {
				var audio = new Audio("wav/button.wav");
				audio.play();
				var myTimeVar = setInterval(
						function() {
							objDiv.scrollTop =  objDiv.scrollHeight;//objDiv.scrollHeight;
							$(".rightbubble").css({ opacity: '0.9' });
						},1);
				setInterval (
				
				function () {
						clearInterval(myTimeVar);
						clearInterval(myTimeVar2);
					},400);
					
				//chatlist is the wrapper 
				$( "#chatlist" ).append( "<div id = 'predynamic' class='leftbubble borderprop'>SEE CHANGE</div> " );
				$('#dynamic').attr('id','static');
				var bufferval = $("#buffer").val();
				$('#predynamic').html(bufferval.replace("#NEWLINE", "<br>")); //dont use .text for linebreaks
				$('#predynamic').attr('id','dynamic');
				$("#buffer").val("");
				
				MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
				
			}
		},500);
		
		</script>
	</head>

	<body onload="document.getElementById('inputbox').focus();">
	<div id="ajaxdropzone">
	<!-- this is where ajax output is stored and the buffer stores the unread text from the other user -->
		<input style="display:none" id = "buffer" value="">
	</div>
		<!-- When $a \ne 0$, there are two solutions to \(ax^2 + bx + c = 0\) and they are
$$x = {-b \pm \sqrt{b^2-4ac} \over 2a}.$$ -->

	
		
		<div class="sidebar borderprrop">
			<div id="fb-root"></div>
			<div id="panel" ng-controller="SidebarCtrl">
				<h3 id="myName"></h3>
				<div id="friendList">
					<li ng-repeat="friend in friends" ng-click="openSendDialog(friend.name,friend.id)">
						<img class="friendPicture" ng-src="{{friend.picture}}"></span>
						<span class="friendRow">{{friend.name}}</span>
					</li>
				</div>
			</div>
			<fb:login-button show-faces="true" width="200" max-row="1" ></fb:login-button>
		</div>
		

		<!-- Weapper Container Div -->
		<div class="container borderprop">
			
			<div class="filebox borderprop" >
				<!--
				<b>Reminder:</b>
				<br><br>
				Write the mathematical expressions enclosed by '[' ']'.
				<br>
				Press 'Insert' to Send
				
				<div class="filetitle borderprop">
					File Trans
				</div>
				<div id="fileinlist">
					<div class="live-tile fileinblk one-tall one-wide" data-delay="0" data-initdelay="0" data-speed="1000" data-mode="flip" data-bounce="true" data-hover-delay="0" data-repeat="0" data-direction="vertical">
						<div>
							<input class="display-none activefill" type="file" />
							<input class="fileinitem activebutton" type="button"/>
						</div>
						<div class="accent fillinback">
							<span class="tile-title" onClick="$(this).closest('div.live-tile').hide();">CANCEL</span>
							<span class="top filename">FILENAME</span>
						</div>
					</div>
				</div>
				-->
			</div>
			
			<div class="chatbox borderprop" > 
				<div class ="chattitle borderprop">
                	Latex Chat using AJAX and MathJAX Library
				</div>
				<div id="chatlist" class="chatlist borderprop">
					<!---messages div will show here -->
					
					<div class="leftbubble borderprop">
						Press 'Insert' to Send
					</div>
					<!--<div class="demo">
						Flip Demo
					</div>-->
					<div class="leftbubble borderprop">
						When $a \ne 0$, there are two solutions to \(ax^2 + bx + c = 0\) and they are
$$x = {-b \pm \sqrt{b^2-4ac} \over 2a}.$$ 
					</div>
				</div>
				<script>
					var objDiv = document.getElementById("chatlist");
					objDiv.scrollTop = objDiv.scrollHeight;
					
				</script>
				<div class="chatinput borderprop">
				<table cellpadding="0" cellspacing="2">
					<tr>
					<form id="textform">
					<td style="background-color: rgb(74,217,217);">
						<div id="ajaxtextareareset">
						<textarea cols="40" id="inputbox" rows="1" class="inputbox" onkeyup='this.rows = (this.value.split("\n").length||1);'
						onkeypress="handleKeyPress(event); "></textarea> 
						</div>
					</td>
					<td style="background-color: rgb(74,217,217);">
						<input id="submit" type="submit" value ="Send" onclick="document.getElementById('inputbox').rows = 1; " class="sendbutton">
					</td>
					</form>
					</tr>
				</table>
			</div>
			
			
			</div>
			
			
		</div>	
		
		
		<script src="sidebar.js"></script>
        <script src="JS/main.js"></script>
	</body>
</html>