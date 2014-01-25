 function toggle_it(itemID){ 
      // PURPOSE: Toggle visibility between none and block
      if ((document.getElementById(itemID).style.display == 'none')) 
      { 
        document.getElementById(itemID).style.display = 'block'; 
      } else { 
        document.getElementById(itemID).style.display = 'none'; 
      } 
  } 
  
 function SetFocus () {
            var input = document.getElementById ("title");
            input.focus ();
        }

function showResult(str)
{
if (str.length==0)
  { 
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  return;
  }
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
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="0px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","NAVIGATION/search_instant.php?q="+str,true);
xmlhttp.send();
}

//AUTOUPDATING TIMER (TheStudentSales)
var myVar;

function autoupdate()
{
	myVar = setInterval(function(){ajaxFunction()},120000);
	cautionary = setInterval(function(){stopautoupdate()},2700000);
}

function stopautoupdate()
{
	clearInterval(myVar);
}

//reaching bottom of the scroll event
function scrolled(e) {
  if (myDiv.offsetHeight + myDiv.scrollTop >= myDiv.scrollHeight) {
    scrolledToBottom(e);
  }
}

//COUNTER (TheStudentSales)

var counter = 10;
// USED FOR INFINITE LIST OF RESULT



//SHOW AND HIDE THINGS (TheStudentSales)
//http://www.codingforums.com/showthread.php?t=221589
function showstuff(element){ 
    document.getElementById("location_labl").style.display = element=="housing"?"block":"none"; 
    document.getElementById("location").style.display = element=="housing"?"block":"none"; 	
    document.getElementById("isbn_labl").style.display = element=="textbooks"?"block":"none"; 
    document.getElementById("isbn").style.display = element=="textbooks"?"block":"none"; 	
} 

function closedown_showstuff(){ 
    document.getElementById("location_labl").style.display = 'none'; 
    document.getElementById("location").style.display = 'none'; 	
    document.getElementById("isbn_labl").style.display = 'none'; 
    document.getElementById("isbn").style.display = 'none'; 	
}