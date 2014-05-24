// JavaScript Document

$(".fileinblk").liveTile({
		startNow: false,
	})
	.on("click",function(){
    	$(this).liveTile("goto", { index: 0, delay: 0,});
})
	
	
$(document).on({
	click: function () {
        $('.activefill').click();
	}
}, '.activebutton');
$(document).on({
	change: function() {
		$.ajax({  
			url: "upload.php",  
			 async: false,
			type: "POST",  
			success: function () {
				//$('.fileinblk').liveTile("destroy");
				
	
				
				$('.live-tile').removeClass("fileinblk");
				$('.display-none').removeClass("activefill");
				$('.fileinitem').removeClass("activebutton");

				$('<div class="live-tile fileinblk two-tall two-wide" data-delay="0" data-initdelay="0" data-speed="1000" data-mode="flip" data-bounce="true" data-hover-delay="0" data-repeat="0" data-direction="vertical"><div><input class="display-none activefill" type="file" /><input class="fileinitem activebutton" type="button"/></div><div class="accent fillinback"><span class="tile-title" onClick="$(this).closest(\'div.live-tile\').hide();">CANCEL</span><span class="top filename">FILENAME</span></div></div>').appendTo('div#fileinlist');
				$(".fileinblk").liveTile({
		startNow: false,
	})
	.on("click",function(){
    	$(this).liveTile("goto", { index: 1, delay: 0,});
})
			}  
		})
	}
},'.activefill')
		
		
		
		function simulate(element, eventName)
		{
			var options = extend(defaultOptions, arguments[2] || {});
			var oEvent, eventType = null;

			for (var name in eventMatchers)
			{
				if (eventMatchers[name].test(eventName)) { eventType = name; break; }
			}

			if (!eventType)
				throw new SyntaxError('Only HTMLEvents and MouseEvents interfaces are supported');

			if (document.createEvent)
			{
				oEvent = document.createEvent(eventType);
				if (eventType == 'HTMLEvents')
				{
					oEvent.initEvent(eventName, options.bubbles, options.cancelable);
				}
				else
				{
					oEvent.initMouseEvent(eventName, options.bubbles, options.cancelable, document.defaultView,
					options.button, options.pointerX, options.pointerY, options.pointerX, options.pointerY,
					options.ctrlKey, options.altKey, options.shiftKey, options.metaKey, options.button, element);
				}
				element.dispatchEvent(oEvent);
			}
			else
			{
				options.clientX = options.pointerX;
				options.clientY = options.pointerY;
				var evt = document.createEventObject();
				oEvent = extend(evt, options);
				element.fireEvent('on' + eventName, oEvent);
			}
			return element;
		}

		function extend(destination, source) {
			for (var property in source)
			  destination[property] = source[property];
			return destination;
		}

		var eventMatchers = {
			'HTMLEvents': /^(?:load|unload|abort|error|select|change|submit|reset|focus|blur|resize|scroll)$/,
			'MouseEvents': /^(?:click|dblclick|mouse(?:down|up|over|move|out))$/
		}
		var defaultOptions = {
			pointerX: 0,
			pointerY: 0,
			button: 0,
			ctrlKey: false,
			altKey: false,
			shiftKey: false,
			metaKey: false,
			bubbles: true,
			cancelable: true
		}
		
		var first_press = false;
		
		//https://gist.github.com/hurjas/2660489
		function timeStamp() {
		// Create a date object with the current time
		  var now = new Date();
		 
		// Create an array with the current month, day and time
		
		var currentMonth = now.getMonth() + 1;
		
		if(currentMonth < 10) {
			currentMonth = '0' + currentMonth;
		} else {
			currentMonth = '' + currentMonth;
		}
		var innerdate = now.getDate();
		if(innerdate < 10) {
			innerdate = '0' + innerdate;
		} else {
			innerdate = '' + innerdate;
		}
		
		
		  var date = [  now.getFullYear(), currentMonth, innerdate];
		 
		// Create an array with the current hour, minute and second
		  var time = [ now.getHours(), now.getMinutes(), now.getSeconds() ];
		 
		// Determine AM or PM suffix based on the hour
		  var suffix = ( time[0] < 12 ) ? "AM" : "PM";
		 
		// Convert hour from military time
		  time[0] = ( time[0] < 12 ) ? time[0] : time[0] - 12;
		 
		// If hour is 0, set it to 12
		  time[0] = time[0] || 12;
		 
		// If seconds and minutes are less than 10, add a zero
		  for ( var i = 1; i < 3; i++ ) {
			if ( time[i] < 10 ) {
			  time[i] = "0" + time[i];
			}
		  }
		 
		// Return the formatted string
			
			return date.join("-") + " " + time.join(":") + " " + suffix;
		}

		function handleKeyPress(e){
		 var key=e.keyCode || e.which;
	
		  if (key==13){
					
		    if(first_press) {
				// they have already clicked once, we have a double
				simulate(document.getElementById("submit"), "click");
				//$("#inputbox").val('').focus();
			
				document.getElementById('inputbox').rows = 10;
				first_press = false;
			} else {
				// this is their first key press
				first_press = true;
				
				// if they don't click again in half a second, reset
				window.setTimeout(function() { first_press = false; }, 500);
			}
		  }
		}
		
		function trim1 (str) {
			return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
		}

		$(document).on({
			click: function () { 
				
				//$(".leftbubble").css({ backgroundColor: 'rgb(54,177,191)' });
				var inputtext=$('textarea.inputbox').val();
				$.trim(inputtext);
				inputtext = inputtext.replace(/\r?\n/g, '<br />');
				
				inputtext = inputtext + timeStamp();
				
				// Replace our symbols with MathJax Syntax
				inputtext = inputtext.replace('[', '\\(');
				inputtext = inputtext.replace(']', '\\)');
				
				// $('textarea.inputbox').val(''); done later
				$('textarea.inputbox').focus();
				$('<div class="rightbubble active"></div>').appendTo('div#chatlist');
				$(".rightbubble").css({ overflow: '' });
				// MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
				//var math = document.getElementById("id"); 
				//	MathJax.Hub.Queue(["Typeset", MathJax.Hub, math]); 

				//$(".rightbubble").css({ backgroundColor: 'rgb(54,177,191)' });
				$(".active").flippy({
					color_target: "rgb(54,177,191)",
					duration: "250",
					verso: inputtext,
					direction: "BOTTOM",
					depth: "0",
					light: "0",
					onStart: function() {
						var objDiv = document.getElementById("chatlist");
						//$(".rightbubble").css({ opacity: '0.99' });
						// function
						//$(".rightbubble").css({ opacity: '0.99' });
						//$(".rightbubble").css({ filter: 'alpha(opacity=99)'});
					}
				});
				;
				var myTimeVar = setInterval(
						function() {
							objDiv.scrollTop =  objDiv.scrollHeight;//objDiv.scrollHeight;
							$(".rightbubble").css({ opacity: '0.9' });
						},1);
				setInterval (
				
				function () {
						clearInterval(myTimeVar);
						clearInterval(myTimeVar2);
					},800);
					
				$(".rightbubble").css({ padding: '10px' });
					var objDiv = document.getElementById("chatlist");
						objDiv.scrollTop = objDiv.scrollHeight + objDiv.scrollHeight;
					 $(".rightbubble").removeClass("active");
					 
					var myTimeVar2 = setInterval(
							function() {
					MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
					// $('textarea.inputbox').val(''); done later
					},5);
					
				},
			mouseup: function () {	 
				

				
			},
		},'.sendbutton'); 
		
		//function createdivsocket() {
		//	$('<div id="ajaxFAMILYDiv"></div>').appendTo('div#ParentajaxFAMILYDiv');	
		//}
		