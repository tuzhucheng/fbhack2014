<?/*
		Title:	PHP JS AJAX CONVERTER	VIA POST FUNCTION VERSION	Effective: April 28, 2013
		________________________________________________________
		*/
//Dependency: classical_functions.php
//include('classical_functions.php'); implicit

function ajaxhandlerpost($ajaxactionfiledirectory,$ajaxfname,$array_get_keys,$divoutput) {

	//$ajaxactionfiledirectory			Directory of targe php file that process ajax call
	//$ajaxfname						Function name for this ajax process
	//$array_get_keys					List of $_GET() keys
	//$array_get_argument_placeholder	Place holders for variables
	//$divoutput						Result of ajax action in target php shows here
	
	$key_string = implode(",",$array_get_keys);
	
	foreach ($array_get_keys as $key => $val) { 
		//$key is a number, $val is the  GET key
		$i = $i + 1;
		$growingstringq =  cl_stringsnake($growingstringq,' + "&',$val.'=" + arg'.$i);//--> classical_functions.php
		$growingstringarg =  cl_stringsnake($growingstringarg,",","arg".$i);//--> classical_functions.php
	} 

	$growingstringq = '"'.$growingstringq;
	
	?>
	<script>
		function <? echo $ajaxfname?>(<? echo $growingstringarg ?>)
		{
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("<? echo $divoutput;?>").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("POST","<? echo $ajaxactionfiledirectory;?>",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(<? echo $growingstringq;?>);
		}
	</script>
	<?
}
?>