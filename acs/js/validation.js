$(document).ready(function(r){
$('#save').bind('click', function(e){
   if( $('#File1').val() != ""){
       return true;
   }
   else{
       alert('No file selected');
	   return false;
   }
});


$('#save').bind('click', function(e){
   if( $('#query').val() != ""){
       return true;
   }
   else{
       alert('Please write query');
	   return false;
   }
});

$('#save').bind('click', function(e){
   if( $('#html').val() != ""){
       return true;
   }
   else{
       alert('Please write table');
	   return false;
   }
});
});

function show()
{
	document.getElementById('code1').style.visibility= 'visible' ;
}
