<?php
// User's footer file
?>

<!-- footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h6>Copyright © 2016 MITRE / Monmouth University</h6>
            </div><!-- end col-sm-2 -->

            <div class="col-sm-4">
                <h6>About Us</h6>
                <p>MITRE - Skills Endorsement</p>
            </div><!-- end col-sm-4 -->

            <div class="col-sm-4">
                <h6>Navigation</h6>
                <ul class="unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div><!-- end col-sm-2 -->
        </div><!-- end row -->
    </div><!-- end container -->
</footer>

</body>
</html>


<script type="text/javascript">
	
$(document).ready(function(){	
	
	/*Notification - message count*/
	$(function(){
		
		
		var dataString = 'user_id=<?php echo $userid;?>';
		
		/* AJAX Call */
        $.ajax({
            cache: false,
            type: 'GET',
            url: 'notification_getCount.php',
            data: dataString,
            success: function(data)
            {
                
                var message=$('#nbrmsg');
                
                message.empty();
                message.append(data);
        
				// Animate the count - if not empty
				if(!message.is(':empty')){
					$('#nbrflag').append(message);
					message.show('slow');
				}

            },
            error: function(){
                alert("fail to load notification count - please contact sys admin!");
            }
        });
        /* End of AJAX Call */
		
	});
	
	/*Notification - flag click - load drop downbox*/
    $('#nbrflag').click(function(){ 
        
       //alert("Clicked");
       
       var loadingContent = '<li><div id="ajax_loader"><img class="img-responsive center-block" src="../images/ajax-loader.gif"></img></div></li>';
       
       
       // Show ajax loading icon
       $('#nbrcontent').append(loadingContent);
		
       
       var dataString = 'user_id=<?php echo $userid;?>';
		
		/* AJAX Call */
        $.ajax({
            cache: false,
            type: 'GET',
            url: 'notification_getContent.php',
            data: dataString,
            success: function(data)
            {
                
                var message=$('#nbrcontent');
                
                message.empty();
                message.append(data);
                //message.show('slow');
                
                // Remove unread message count form the flag
                setTimeout(
				  function() 
				  {
				    //do count after a few seconds
				    var nbrmsg=$('#nbrmsg');
					nbrmsg.empty();
					nbrmsg.css('display', 'none');
				  }, 100);
                
                
            },
            error: function(){
                alert("fail to load notification content - please contact sys admin!");
            }
        });
        /* End of AJAX Call */

        
 
    });
	

 }); // End of ready function	
</script>



