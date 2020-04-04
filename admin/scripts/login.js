$('document').ready(function(){
    $('#login').on('click', function(event){

        event.preventDefault();
        let username = $('#username').val();
        let password = $('#password').val();

        if(username != '' && password != ''){

            $.ajax({
                url: 'login.php',
                method: 'POST',
                data: {
                    username: username, 
                    password: password
                },
                success: function(data){
                    data = JSON.parse(data);
                    if(data.statusCode == 200){
                        location.assign('../office/');
                    }
                    else if(data.statusCode == 201){
                        $('#result').html(data['result']);
                        username = $('#username').val('');
                        password = $('#password').val('');
                    }
                }
            });
        }
        else if(username == ''){
            $('#result').html('Username is required');
        }
        else if(password == ''){
            $('#result').html('Password is required');
        }
    });
});