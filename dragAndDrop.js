$(function(){

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload
    (
    	{

	        // This element will accept file drag/drop uploading
	        dropZone: $('#drop'),
	
	        fail:function(e, data){
	            // Something has gone wrong!
	            data.context.addClass('error');
	        },
	        success:function(data,error)
	        {
	        	$('#response').html(data);
	        	$('.fancybox').fancybox();
	        }

    	}
    );

    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });



});