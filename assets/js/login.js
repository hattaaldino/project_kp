    $(document).ready(function() { 
        $('#login').on('click', function(){
            username = $('#inputusername').val();
            password = $('#inputPassword').val();

            let data = {
                username : username,
                password : password
            }

            $.ajax({
                url: "http://192.168.100.6/sc_contractor_api/api/Login",
                method : 'POST',
                data : data,
                success: function(response)
                {
                    id = response.data[0].id;
                    nama = response.data[0].nama;
                    role = response.data[0].role;

                    var unique_user = false;

                    var valid_user = false;

                    if(response.data.length <= 1){
                        unique_user = true
                    }

                    if( !(id == '') || !(nama == '') || !(role == '') ){
                        valid_user = true;
                    }

                    if(unique_user && valid_user){

                        if (role == 'owner')
                        {
                            $.ajax({
                            url: "<?php echo base_url('controllers/user_session/userIn'); ?>",
                            method : 'POST',
                            data : response.data,
                            success: function()
                            {
                                window.location.href="<?php echo base_url('contractor/owner_board'); ?>";
                            }
                            })
                        }

                        else if (role == 'kontraktor') 
                        {
                            $.ajax({
                            url: "<?php echo base_url('controllers/user_session/userIn'); ?>",
                            method : 'POST',
                            data : response.data,
                            success: function()
                            {
                                window.location.href="<?php echo base_url('contractor/kontraktor_board'); ?>";
                            }
                            })
                        }

                        else if (role == 'pengawas')
                        {
                            $.ajax({
                            url: "<?php echo base_url('controllers/user_session/userIn'); ?>",
                            method : 'POST',
                            data : response.data,
                            success: function()
                            {
                                window.location.href="<?php echo base_url('contractor/pengawas_board'); ?>";
                            }
                            })
                        }
                    }
                },
                error: function(){
                    $('.alert').fadeIn();
                }
            })
        });
    });