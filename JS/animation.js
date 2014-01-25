var JQFUNCS =
    {
        runFunc:
        {
            /* ------------------------------ Animation Demo 1 ------------------------------ */
            "animate1":
            {
                run: function(id)
                {
                    $('#'+id)
                    .html('This text is bigger than before.')
                    .animate({
                        fontSize: "30px"
                    }, 1500);
                },
                reset: function(id)
                {
                    $('#'+id)
                    .animate({
                        fontSize: "12px"
                    }, 1500, function() {
                        $(this).html('This text is smaller than before.')
                    });
                }
            },
 
            /* ------------------------------ Animation Demo 2 ------------------------------ */
            "animate2":
            {
                run: function(id)
                {
                    $('#'+id).animate({
                        width:600,
                        height:340
                    }, 250);
					var focustimer;
					 focustimer = setInterval(function(){SetFocus ()},300);
					 /*Oct 28, 2012 set focus to the post title input after 3 seconds (after animation finishes)*/
					 cautionary = setInterval(function(){clearInterval(focustimer)},310);
					 /* to prevent "cursor glue" where the cursor gets stuck to the input box every 0.3 sconds */
                },
 
                reset: function(id)
                {
                    $('#'+id).animate({
                        width:600,
                        height:12
                    }, 250);
                }
            },
 
            /* ------------------------------ Animation Demo 3 ------------------------------ */
            "animate3":
            {
                run: function(id)
                {
                    $('#car1').animate({marginLeft: "+=550px"}, 2000);
                    $('#car2').animate({marginLeft: "+=550px"}, 800);
                    $('#car3').animate({marginLeft: "+=550px"}, 5500);
                    $('#car4').animate({marginLeft: "+=550px"}, 2500);
                    $('#car5').animate({marginLeft: "+=550px"}, 4000);
                },
 
                reset: function(id)
                {
                    $('#'+id+' img').each( function(i,v)
                    {
                        $(this).stop().css({'margin':'0'});
                    });
                }
            }
        }
    }