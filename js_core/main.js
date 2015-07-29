function ajax_all(url,form_id,button,container)
{
	 
	 var is_validated = false;
	 var value = false;
	 var oldbutton = "";
	 var flag = $("#flag");
     var currurl = window.location.href; 
     var identifier = currurl.indexOf("?");
     currurl = currurl.substr(identifier,currurl.length);
     

     if(button.text() == "")
     {
     	value = true;
     	oldbutton = button.attr("value");
  		
     	button.attr({
     		"value": 'Loading',
     		"disabled":"disabled"
     		
     	});


     	
     }
     else
     {
     	oldbutton = button.text();
     	button.text("Loading");
     	button.attr({
     		"disabled":"disabled"
     	});
     }

     	
	 //button.parent().children(".change_responce").html('Loading .. <img class =  "loading" src="ajax/328-a.gif" width = "16px" height = "16px"/>');
	 $.ajax({ type: "POST",   
		     url: url+currurl,  
		     data: $("#"+form_id).serialize(),
			 async:false,
		     success : function(data,status,xhr)
		     {
		     	$(".loading").fadeOut('200', function() {
		         	$(this).remove();
		         });


		     	
		     	if( xhr.getResponseHeader("ajax_response") == "error")
		     	{
		     		$.notify(data,"warning");
		     		
		     		is_validated =  false;
		     		if(value == true)
		     		{
		     			button.attr({
				     		"value": oldbutton	
				     	});
				     	button.removeAttr('disabled');
		     		}
		     		else
		     		{
		     			button.text(oldbutton);
	     				button.removeAttr('disabled');
		     		}

		     		
		     	}
		     	else if(xhr.getResponseHeader("ajax_response") != "error")
		     	{
	     			result = data;   
			     	//button.parent().children(".change_responce").html(data);  
			     	
			     	if(container != null && container.length > 0 )
			     	{
			     		
			     		container.html(data);
			     		$.notify("Done","success");
			     		is_validated = true;
			     			button.removeAttr('disabled');
			     	
			     		
			     	}
			     	else
			     	{
			     		$.notify(result,"success");
			     		is_validated = true;
			     			button.removeAttr('disabled');
			     	
			     		
			     	}

			     	if(value == true)
		     		{

		     			button.attr({
				     		"value": oldbutton
				     		
				     	});
		     		}
		     		else
		     			button.text(oldbutton);
		     		
		     	}
		     	
		     	
		     	 
		     }


			});

	
	
	return is_validated;
	 
}


$(".summary-field").on("keyup",function(event) {
	
	var value = $(this).val();
	var dst_id = $("#"+ $(this).attr("data-dst") );

	dst_id.text(value);



});

$(".summary-field[type='radio'],select.summary-field").on("click",function(event) {
	
	var value = $(this).val();
	var dst_id = $("#"+ $(this).attr("data-dst") );

	dst_id.text(value);



});



