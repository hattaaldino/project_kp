$(document).ready(function(){
    $('#daftarbtn').on('click', function(){
        nama = $('#nama').val();
        username = $('#username').val();
        password = $('#inputpassword').val();
        alamat = $('#ddress').val();
        telepon = $('#telp').val();
        profile = $('#image').prop('files');

        if(username == ''){
            $('#alert-username').fadeIn();
        }

        else if(nama == ''){
            $('#alert-name').fadeIn();
        }

        else if(password == ''){
            $('#alert-password').fadeIn();
        }
        
        else{
            var role = $('#username').dataset.role;

            let form_data = new FormData();
            form_data.append('nama', nama);
            form_data.append('username', username);
            form_data.append('password', password);
            form_data.append('role', role);
            form_data.append('alamat', alamat);
            form_data.append('telepon', telepon);
            form_data.append('profile', profile);

            $.ajax({
                url: "http://192.168.100.6/sc_contractor_api/api/Login",
                method: 'POST',
                data: form_data,
                processData: false,
                contentType: false,
                success: function(){
                    $.ajax({
                        url: "<?php echo base_url('controllers/user_session/userIn'); ?>",
                        method : 'POST',
                        data : "{'nama' : "+nama+", 'username' : "+username+", 'password' : "+password+", 'role' : "+role+"}",
                        success: function(){
                            window.location.href="<?php echo base_url('contractor/kontraktor_board'); ?>";
                        },
                        error: function(){
                            $('#alert-username').fadeIn();
                        }
                    })
                },
                error: function(){
                    $('#alert-username').fadeIn();
                }
            })
        }
    });
});