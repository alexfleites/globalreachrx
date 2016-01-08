var state = false;
$(document).ready(function() {
    $('#submit_all').click(function() {
        goer();
        $forms = $('form');
        sent = 0;
        $forms.each(function() {
            if(state) {
            $.ajax({
                type: "post",
                async: false,
                url: $(this).attr("action"), 
                data: $(this).serialize(), 
                success: function(data) { 
                    if(++sent == $forms.length) {
				bootbox.alert(" <h4 class='modal-title' id='myModalLabel'>Application Creation Success:</h4></div><div class='modal-body'>- All required codes where generated successfully.<br>- Admin creation successful.<br><br>  <a href='CodeOutput/index.php' target='_blank' class='btn btn-info'>Preview App </a></div>");
                    }
                }
            });
            } else { return false; }
        });
        stoper();
    });

    $('#loader').hide().click(stoper);
    function goer() {
        if(!state) {
            state = true;
            $('#submit_all').hide();
            $('#loader').show();
            $('input[type=button], input[type=submit]').attr("disabled", "disabled");
    }}
    function stoper() {
        if(state) {
            state = false;
            $('#submit_all').show();
            $('#loader').hide();
            $('input[type=button], input[type=submit]').removeAttr("disabled");
    }}
});
	  
//SLUG	
	$("#sqlcode").keyup(function(){
        var Text = $(this).val();
        $("#output").val(Text);        
});

$('#myModal').modal('show');