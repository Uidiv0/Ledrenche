document.addEventListener('DOMContentLoaded',function(){
    (function($){
        $('.getWpToken').click(function(){
            var w = 600;
            var h = 800;
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            var callback = window.location.href;
            var url = $(this).attr('href')+'&callback='+encodeURI(callback);
            window.open(url, null, "height="+w+",width="+h+",left="+left+",top="+top+",status=yes,toolbar=no,menubar=no,location=no");
            return false;
        });

        $('#remove-token').click(function(){
            var result = confirm('Remove WordPress Token?');
            if(result==true){
                $(this).parent().find('input').removeAttr('disabled').val('');
                $(this).hide();
                $('#form_wp').submit();
            }
        });

        var token = $('#token');
        if(token.val()!=''){
            token.attr('disabled','disabled');
            $('#remove-token').show();
        }else{
            $('#save-token').show();
        }

    })(jQuery);
});

window.addEventListener('message', function(event) {
    (function($){
        if(event.origin.match('riddle\.com$') && event.isTrusted){
            $('#form_wp').find('input').removeAttr('disabled');
            $('#form_wp').find('button').html('Saved');
            $('#token').val(event.data.token);
            $('#form_wp').submit();
        }
    })(jQuery);
});