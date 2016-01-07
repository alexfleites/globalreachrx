
<!--NOTIFICATION JS-->
$(function(){$.miniNotification=function(e,t){var n,r,i,s,o,u,a=this;this.defaults={position:"top",show:true,effect:"slide",opacity:.95,time:4e3,showSpeed:600,hideSpeed:450,showEasing:"",hideEasing:"",innerDivClass:"inner",closeButton:false,closeButtonText:"close",closeButtonClass:"close",hideOnClick:true,onLoad:function(){},onVisible:function(){},onHide:function(){},onHidden:function(){}};o="";this.settings={};this.$element=$(e);s=function(e){return o=e};r=function(){var e,t;t=a.getSetting("effect")==="slide"?0-a.$element.outerHeight():0;e={};if(a.getSetting("position")==="bottom"){e["bottom"]=t}else{e["top"]=t}if(a.getSetting("effect")==="fade"){e["opacity"]=0}return e};i=function(){var e;e={opacity:a.getSetting("opacity")};if(a.getSetting("position")==="bottom"){e["bottom"]=0}else{e["top"]=0}return e};u=function(){a.$elementInner=$("<div />",{"class":a.getSetting("innerDivClass")});return a.$element.wrapInner(a.$elementInner)};n=function(){var e;e=$("<a />",{"class":a.getSetting("closeButtonClass"),html:a.getSetting("closeButtonText")});a.$element.children().append(e);return e.bind("click",function(){return a.hide()})};this.getState=function(){return o};this.getSetting=function(e){return this.settings[e]};this.callSettingFunction=function(t){return this.settings[t](e)};this.init=function(){var e=this;s("hidden");this.settings=$.extend({},this.defaults,t);if(this.$element.length){u();if(this.getSetting("closeButton")){n()}this.$element.css(r()).css({display:"inline"});if(this.getSetting("show")){this.show()}if(this.getSetting("hideOnClick")){return this.$element.bind("click",function(){if(e.getState()!=="hiding"){return e.hide()}})}}};this.show=function(){var e=this;if(this.getState()!=="showing"&&this.getState()!=="visible"){s("showing");this.callSettingFunction("onLoad");return this.$element.animate(i(),this.getSetting("showSpeed"),this.getSetting("showEasing"),function(){s("visible");e.callSettingFunction("onVisible");return setTimeout(function(){return e.hide()},e.settings.time)})}};this.hide=function(){var e=this;if(this.getState()!=="hiding"&&this.getState()!=="hidden"){s("hiding");this.callSettingFunction("onHide");return this.$element.animate(r(),this.getSetting("hideSpeed"),this.getSetting("hideEasing"),function(){s("hidden");return e.callSettingFunction("onHidden")})}};this.init();return this};return $.fn.miniNotification=function(e){return this.each(function(){var t;t=$(this).data("miniNotification");if(t===void 0){t=new $.miniNotification(this,e);return $(this).data("miniNotification",t)}else{return t.show()}})}})

<!--CALL NOTIFICATION-->
		 $(function() {
        $('.heze-notify').miniNotification({closeButton: true, closeButtonText: '<i class="fa fa-times"></i>'});
      });
	  
		/*HTML DATA TABLE*/
		$(function () {
			$('table').footable();
        });

		
		/*TOOL TIP*/
	$(document).ready(function() {
    $(".tip").tooltip();
	});
	
	/*SCROLLER*/	
	$(function(){
      $('.divscroll').slimscroll({
        height: '98%'
      });
    });
	
	
	//Date picker
	$(function(){
			window.prettyPrint && prettyPrint();
			$('.datepicker').datepicker({
				format: 'yyyy-mm-dd'
			});
			
		});

//MODAL BOX
$(document).ready(function() {
	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><a class="btn btn-success" id="dataConfirmOK">Confirm</a><button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></div></div>');
		} 
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').attr('href', href);
		$('#dataConfirmModal').modal({show:true});
		return false;
	});
});


//MULTI FIELDS
var startingNo = -1;
	var $node = "";
	for(varCount=0;varCount<=startingNo;varCount++){
		var displayCount = varCount+1;
		$node += '<span><input type="file" name="gfile[]" id="gfile[]" class="styler" style="padding:0px;"><span class="removeVar btn btn-xs btn-danger">Remove</span></span>';
	}
	$('form').prepend($node);
	$('form').on('click', '.removeVar', function(){
		$(this).parent().remove();
		//varCount--; to show numbers '+varCount+'
	});
	$('#addVar').on('click', function(){
		varCount++;
		$node = '<span> <input type="file" name="gfile[]" id="gfile[]" class="styler" style="padding:0px; width:220px; margin-top:-10px;"><span class="removeVar btn btn-xs btn-danger " style="margin-left:220px; margin-top:-50px;">Remove</span></span>';
		$(this).parent().before($node);
	});
	
	//LIGHTBOX	
	 $(function() {
    $(".gallery a[data-rel^='hezebox']").lightbox(); 
  });
  

/*Form ajax*/	
  $(document).ready(function()
{
    $('#hezecomform').on('submit', function(e)
    {
        e.preventDefault();
        $('#msgButton').attr('disabled', '');
        $(".output").html('<div><i class="fa fa-spinner fa-spin fa-2x"></i> Processing...</div>');
        $(this).ajaxSubmit({
        target: '.output',
        success:  afterSuccess
        });
    });
    
    $('#hEmailButton').on('click', function(e){
		e.preventDefault();
		$('#hEmailButton').attr('disabled', '');
		$(".output").html('<div><i class="fa fa-spinner fa-spin fa-2x"></i> Processing...</div>');
		$.ajax({
			type: 'POST',
			url: '../mailcard.php',
			data: {pid:$('input#pid').val()},
			success: function(data){
				$('#hEmailButton').removeAttr('disabled');
				if(data.indexOf('success') == -1){
					$(".output").html('<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '+data+'</div>');
				}else{
					$(".output").html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Card was emailed to patient address successfully!</div>');
				}
				setTimeout(function(){
				  $(".output").html('');
				}, 5000);
				//console.log(data);
			}		   
		});
		return false;
    });

    $('#hDownloadButton').on('click', function(e){
		e.preventDefault();
		window.location.replace("../download.php?pid=" + $('input#pid').val());
    });

});
 
function afterSuccess()
{
    $('#msgButton').removeAttr('disabled'); //enable submit button
} 

//EDITORS
//html5 
 $(function () {
        //$(".editor2").wysihtml5();
      });	
	  
//TynyMCE	  
/*
tinymce.init({
    selector: "textarea.editor1",
    theme: "modern",
    width: "auto",
    height: 200,
    plugins: [
         "advlist autolink link image lists charmap  preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality   paste textcolor"
   ],
   toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink  jbimages | print preview ", 
  
		relative_urls: false
 }); 
*/

	//Chosen
	$(".choz").chosen({
    disable_search: false,
    no_results_text: "No Search Results!",
	width: "100%",
  });
	