$(document).ready(function() {

  	$.ajaxSetup({ cache: true }); // true will cache SDK locally between pages
  	$.getScript('//connect.facebook.net/en_US/all.js', function(){
    	FB.init({
      	appId: '1457681984452177',
      	status     : true, // check login status
    	cookie     : true, // enable cookies to allow the server to access the session
    	xfbml      : true  // parse XFBML
		});     

    $('#loginbutton,#feedbutton').removeAttr('disabled');

    // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  	// for any authentication related change, such as login, logout or session refresh. This means that
  	// whenever someone who was previously logged out tries to log in again, the correct case below 
  	// will be handled. 
  	FB.Event.subscribe('auth.authResponseChange', function(response) {
	    // Here we specify what we do with the response anytime this event occurs. 
	    if (response.status === 'connected') {
		    // The response object is returned with a status field that lets the app know the current
		    // login status of the person. In this case, we're handling the situation where they 
		    // have logged in to the app.
		    console.log("response.status is connected");
		    $("#panel").show();
		    testAPI();
		    getMyName();
		    getFriendList();
	    } else if (response.status === 'not_authorized') {
	        // In this case, the person is logged into Facebook, but not into the app, so we call
	        // FB.login() to prompt them to do so. 
	        // In real-life usage, you wouldn't want to immediately prompt someone to login 
	        // like this, for two reasons:
	        // (1) JavaScript created popup windows are blocked by most browsers unless they 
	        // result from direct interaction from people using the app (such as a mouse click)
	        // (2) it is a bad experience to be continually prompted to login upon page load.
	        console.log("response.status is not authorized");
	        $("#panel").hide();
	        loginAndRequestPermissions();
	    } else {
	        // In this case, the person is not logged into Facebook, so we call the login() 
	        // function to prompt them to do so. Note that at this stage there is no indication
	        // of whether they are logged into the app. If they aren't then they'll see the Login
	        // dialog right after they log in to Facebook. 
	        // The same caveats as above apply to the FB.login() call here.
	        console.log("response.status is unknown");
	        $("#panel").hide();
	        loginAndRequestPermissions();
	    }
    });
  });

/*	MutationObserver = window.MutationObserver || window.WebKitMutationObserver;
	var observer = new MutationObserver(function(mutations, observer) {
		// fired when a mutation occurs
		console.log(mutations, observer);
	});

	observer.observe($("#fb-root").get(0), {
		subtree: true,
		attributes: true
	});*/

});

function loginAndRequestPermissions() {
	FB.login(function() {}, {scope: 'read_friendlists, friends_photos'});
}

// Here we run a very simple test of the Graph API after login is successful. 
// This testAPI() function is only called in those cases. 
function testAPI() {
	console.log('Welcome!  Fetching your information.... ');
	FB.api('/me', function(response) {
	  console.log('Good to see you, ' + response.name + '.');
	});
}

function sortFriendsByAZ(a,b) {
	if (a.name < b.name)
		return -1;
	else if (a.name > b.name)
		return 1;
	else
		return 0
}

function getMyName() {
	FB.api(
	  "/me?fields=name",
	  function(response) {
	    	if (response && !response.error) {
	      		$("#myName").text(response.name);
	    	}
	  });
}

function getFriendList() {
	FB.api(
	  "/me/friends?fields=name,id,picture",
	  function(response) {
	    	if (response && !response.error) {
	    		friendCount = response.data.length;
	    		response.data.sort(sortFriendsByAZ);
	    		for (i = 0; i < friendCount; i++) {
	    			//console.log(response.data[i].name);
	    			angular.element($("#panel")).scope().addFriend(response.data[i].name, response.data[i].picture.data.url, response.data[i].id).$apply();
	    		}
	    	} else {
	    		console.log(response.message);
	    	}
	  });
}

function SidebarCtrl($scope) {
	$scope.friends = [];

	$scope.addFriend = function(newFriendName, newFriendPicture, newId) {
		friend = new Object();
		friend.name = newFriendName;
		friend.picture = newFriendPicture;
		friend.id = newId;
		$scope.friends.push(friend);
		return $scope;
	}

	$scope.openSendDialog = function(name,id) {
/*		request = new Object();
		request.method = 'send';
		request.link = "http://www.google.ca";
		FB.ui(request);*/
		url = "http://www.facebook.com/dialog/send?" +
 				 "app_id=1457681984452177" +
 				 "&link=http://www.uwaterloo.ca" +
 				 "&redirect_uri=http://localhost/fbhack2014/index.html" +
 				 "&to=" + id;
  		window.open(url, "Send a message to " + name, "_blank");
	}
}