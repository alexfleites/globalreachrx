//for menu
$(document).ready(function(){
	$("#hiddenContent").hide();
	$("div#drop1").hide();
	$("div#drop2").hide();
	$("div#drop3").hide();
	$("div#drop4").hide();
	$("div#drop5").hide();
	$("div#drop6").hide();
	
	$("body").click(function() {
    $("div#drop1").hide(1000);
	$("div#drop2").hide(1000);
	$("div#drop3").hide(1000);
	$("div#drop4").hide(1000);
	$("div#drop5").hide(1000);
	$("div#drop6").hide(1000);
    });
	

	$("#drop1").click(function(event){
	$("div#drop1").show(500);
	$("div#drop2").hide();
	$("div#drop3").hide();
	$("div#drop4").hide();
	$("div#drop5").hide();
	$("div#drop6").hide();
	event.stopPropagation();
	});
	
	$("#drop2").click(function(event){
	$("div#drop2").show(500);
	$("div#drop1").hide();
	$("div#drop3").hide();
	$("div#drop4").hide();
	$("div#drop5").hide();
	$("div#drop6").hide();
	event.stopPropagation();
	});
	
	$("#drop3").click(function(event){
	$("div#drop3").show(500);
	$("div#drop1").hide();
	$("div#drop2").hide();
	$("div#drop4").hide();
	$("div#drop5").hide();
	$("div#drop6").hide();
	event.stopPropagation();
	});
	
	$("#drop4").click(function(event){
	$("div#drop4").show(500);
	$("div#drop1").hide();
	$("div#drop2").hide();
	$("div#drop3").hide();
	$("div#drop5").hide();
	$("div#drop6").hide();
	event.stopPropagation();
	});
	
	$("#drop5").click(function(event){
	$("div#drop5").show(500);
	$("div#drop1").hide();
	$("div#drop2").hide();
	$("div#drop3").hide();
	$("div#drop4").hide();
	$("div#drop6").hide();
	event.stopPropagation();
	});
	
	$("#drop6").click(function(event){
	$("div#drop6").show(500);
	$("div#drop1").hide();
	$("div#drop2").hide();
	$("div#drop3").hide();
	$("div#drop4").hide();
	$("div#drop5").hide();
	event.stopPropagation();
	});

	

	$("#arrayTable").hide();
	
	$("#array").click(function(){
	$("#arrayTable").show();
	$("#dummyTable").hide();
		});


/*****for import CSV files*****/
$("#field-list-div").hide();
$(".imported_table").change(function(){
                     $.ajax({
                            url: "../../ajaxOperation.php",
                            type:'POST',
                            data:{operation:"getColumns",
							tables:$(this).val()
							},
	                        success:function(output_string){
                                  $(".result-table").html(output_string)
				  $("#hiddenContent").show();
				 }
			 });
		});
		
	$(".demosql").on('click',function(){
		alert("Execute Query Does Not Work In Demo Versio");
		return false;
		});
});	





