$('ducoment').ready(function(){
    $('#install').on('click', function(){
        $('.loading').show();
        $.ajax({
            url: 'tablescreate.php',
            method: 'POST',
            success: function(){
                setTimeout(function(){
                    $.ajax({
                        url: 'tablespopulate.php',
                        method: 'POST',
                        success: function(data){
                            data = JSON.parse(data);
                            $('.loading').hide();
                            $('#info').html(data);
                            $('#install').html('Log in');
                            $('#install').on('click', function(){
                                $('.loading').hide();
                                location.assign('../login/');
                            });
                        }
                    });
                },5000)            
            }
        });
    });
});