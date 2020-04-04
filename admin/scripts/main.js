$('document').ready(function(){

    // User Menu
    $('#userinfo').on('click', function(){
        if($('#usermenu').is(':visible')){
            $('#usermenu').hide();
        }
        else{
            $('#usermenu').show();
        }
    });

    // Main Menu   
    $('#openmenu').on('click', function(){
        $('#openmenu').hide();
        $('#closemenu').show();
        $('.menutitle').show();
        $('.menuitems').show();
        $('.mainmenu').width('300px');
        $('#main').css('margin-left','300px');
    });
    $('#closemenu').on('click', function(){
        $('#openmenu').show();
        $('#closemenu').hide();
        $('.menutitle').hide();
        $('.menuitems').hide();
        $('.mainmenu').width('0px');
        $('#main').css('margin-left','0px');
    });

    //User Menu Clickables

    // Logout
    $('#logout').on('click', function(){
        $.ajax({
            url: '../include/logout.php',
            method: 'POST',
            success: function(){
                location.replace('../login/');
            }
        });
    });

    //Main Menu Clickables

    //Dashboard
    $('#dashboard').on('click', function(){
        $.ajax({
            url: '/admin/office/dashboard/',
            method: 'GET',
            dataType: 'html',
            success: function(data){
                $('#container').html(data);
            }
        });
    });

    //Users
    $('#users').on('click', function users(){
        $.ajax({
            url: '/admin/office/users/',
            method: 'GET',
            dataType: 'html',
            success: function(data){
                $('#container').html(data);

                // Manage Users (Add User)
                $('#adduser').on('submit', function(event){
                    event.preventDefault();

                    let firstname = $('#firstname').val();
                    let lastname = $('#lastname').val();
                    let username = $('#username').val();
                    let password = $('#password').val();
                    let email = $('#email').val();
                    let phone = $('#phone').val();
                    let role = $('#role').val();
                    let result = $('#useraddresult');
                    
                    if(firstname != '' && lastname != '' && username != '' && password != '' && email != '' && phone != ''){
                        $.ajax({
                            url: '/admin/office/users/adduser.php',
                            method: 'POST',
                            data: {
                                firstname: firstname,
                                lastname: lastname,
                                username: username,
                                password: password,
                                email: email,
                                phone: phone,
                                role: role
                            },
                            success: function(data){
                                data = JSON.parse(data);
                                if(data.statusCode == 200){
                                    result.html(data['result']);
                                    result.css("display","inline-block");
                                    result.addClass("approved");
                                    result.removeClass("declined");
                                }
                                else if(data.statusCode == 201){
                                    result.html(data['result']);
                                    result.css("display","inline-block");
                                    result.addClass("declined");
                                }
                                else{
                                    result.html("Unknown error!");
                                    result.css("display","inline-block");
                                    result.addClass("declined");
                                }
                                setTimeout(function(){
                                    users();
                                },1500);
                            }
                        });
                    }
                    else if(firstname == '' && lastname == '' && username == '' && password == '' && email == '' && phone == ''){
                        result.html('All fields are empty!');
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                    else if(firstname == ''){
                        result.html('Firstname is mandatory!');
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                    else if(lastname == ''){
                        result.html('Lastname is mandatory!');
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                    else if(username == ''){
                        result.html('Username is mandatory!');
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                    else if(password == ''){
                        result.html('Password is mandatory!');
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                    else if(email == ''){
                        result.html('Email is mandatory!');
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                    else if(phone == ''){
                        result.html('Phone number is mandatory!');
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                });

                // Manage Users (Edit User)
                $('#updateuser').on('submit', function(event){
                    event.preventDefault();

                    let userid = $('#userid').val();
                    let editfirstname = $('#editfirstname').val();
                    let editlastname = $('#editlastname').val();
                    let editusername = $('#editusername').val();
                    let editpassword = $('#editpassword').val();
                    let editemail = $('#editemail').val();
                    let editphone = $('#editphone').val();
                    let editrole = $('#editrole').val();
                    let result = $('#usereditresult');
                    
                    if(userid != ''){
                        $.ajax({
                            url: '/admin/office/users/edituser.php',
                            method: 'POST',
                            data: {
                                userid: userid,
                                editfirstname: editfirstname,
                                editlastname: editlastname,
                                editusername: editusername,
                                editpassword: editpassword,
                                editemail: editemail,
                                editphone: editphone,
                                editrole: editrole
                            },
                            success: function(data){
                                data = JSON.parse(data);
                                if(data.statusCode == 200){
                                    result.html(data['result']);
                                    result.css("display","inline-block");
                                    result.addClass("approved");
                                    result.removeClass("declined");
                                }
                                else{
                                    result.html("Unknown error!");
                                    result.css("display","inline-block");
                                    result.addClass("declined");
                                }
                                setTimeout(function(){
                                    users();
                                },1500);
                            }
                        });
                    }
                    else if(userid == ''){
                        result.html("Please enter User ID!");
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                });
                $('.remove').on('click', function(){
                    let finalcheck = confirm("Are you sure you want to remove this user?");
                    if(finalcheck){
                        let userid = $(this).data('id');
                        $.ajax({
                            url: '/admin/office/users/remove.php',
                            method: 'POST',
                            data: {userid:userid},
                            success: function(data){
                                data = JSON.parse(data);
                                console.log(data['result']);
                                users();
                            }
                        });
                    }
                });
            }
        });
    });
    //Roles
    $('#roles').on('click', function roles(){
        $.ajax({
            url: '/admin/office/roles/',
            method: 'GET',
            dataType: 'html',
            success: function(data){
                $('#container').html(data);
                // Role Select
                $('#roleid').on('keyup', function(){
                    let editroleid = $('#roleid').val();
                    if(editroleid != ''){
                        $.ajax({
                            url: '/admin/office/roles/checks.php',
                            method: 'POST',
                            dataType: 'html',
                            data: { editroleid: editroleid },
                            success: function(data){
                                $('#editchecks').html(data)
                            }
                        });
                    }
                    else{
                        roles();
                    }
                });
                //Edit role
                $('#updaterole').on('submit', function(event){
                    event.preventDefault();

                    let roleid = $('#roleid').val();
                    let rolename = $('#editrolename').val();
                    let roledesc = $('#editroledesc').val();
                    let permissions = [];
                    let result = $('#editroleresult');

                    $('.selected').each(function(){
                        if($(this).is(':checked')){
                            permissions.push($(this).data('id'));
                        }
                    });

                    if(roleid != ''){
                        $.ajax({
                            url: '/admin/office/roles/editrole.php',
                            method: 'POST',
                            data: {
                                roleid: roleid,
                                rolename: rolename,
                                roledesc: roledesc,
                                permissions: permissions
                            },
                            success: function(data){
                                data = JSON.parse(data);    
                                if(data.statusCode == 200){
                                    result.html(data['result']);
                                    result.css("display","inline-block");
                                    result.addClass("approved");
                                    result.removeClass("declined");
                                }
                                setTimeout(function(){
                                    roles();
                                },1500);
                            }
                        });
                    }
                    else{
                        result.html("Please enter Role ID");
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                });
                // Add Role
                $('#newrole').on('submit', function(event){
                    event.preventDefault();

                    let rolename = $('#rolename').val();
                    let roledesc = $('#role_description').val();
                    let permissions = [];
                    let result = $('#addroleresult');

                    $('.selected').each(function(){
                        if($(this).is(":checked")){
                            permissions.push($(this).data('id'));
                        }
                    });
                    
                    if(rolename != '' && roledesc != ''){
                        $.ajax({
                            url: '/admin/office/roles/addrole.php',
                            method: 'POST',
                            data: {
                                rolename: rolename,
                                roledesc: roledesc,
                                permissions: permissions
                            },
                            success: function(data){
                                data = JSON.parse(data);
                                if(data.statusCode == 200){
                                    result.html(data['result']);
                                    result.css("display","inline-block");
                                    result.addClass("approved");
                                    result.removeClass("declined");
                                }
                                else if(data.statusCode == 201){
                                    result.html(data['result']);
                                    result.css("display","inline-block");
                                    result.addClass("declined");
                                }
                                setTimeout(function(){
                                    roles();
                                },1500);
                            }
                        });
                    }
                    else if(rolename == '' && roledesc == ''){
                        result.html("All the fields are empty!");
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                    else if(rolename == ''){
                        result.html("Role name required!");
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                    else if(roledesc == ''){
                        result.html("Role description required!");
                        result.css("display","inline-block");
                        result.addClass("declined");
                    }
                });
                //Remove role
                $('.remove').on('click', function(){
                    let finalcheck = confirm("Are you sure you want to remove this role?");
                    if(finalcheck){
                        let roleid = $(this).data('id');
                        $.ajax({
                            url: '/admin/office/roles/remove.php',
                            method: 'POST',
                            data: {roleid:roleid},
                            success: function(data){
                                data = JSON.parse(data);
                                console.log(data['result']);
                                roles();
                            }
                        });
                    }
                });
            }
        });
    });
    //Permissions
    $('#permissions').on('click', function(){
        $.ajax({
            url: '/admin/office/permissions/',
            method: 'GET',
            dataType: 'html',
            success: function(data){
                $('#container').html(data);
            }
        });
    });    

});
