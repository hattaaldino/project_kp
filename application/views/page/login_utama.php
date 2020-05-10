    <main role="main" class="inner cover">    
        <img class="mb-4" src="<?php echo base_url();?>user_guide/_images/logo_main.png" height="63" width="285">
        <h1 class="h3 mb-3 font-weight-semibold">Please Sign In</h1>

        <div class="alert alert-warning alert-dismissible " style="display: none" role="alert">
          <strong>Login Gagal!</strong> pastikan data yang anda masukkan sudah benar.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="form-signin">
          <label for="inputusername" class="sr-only">Username</label>
          <input type="username" id="inputusername" class="form-control" placeholder="Username" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required >
              <div class="checkbox mb-1" id="div1">
                  <label>
                      <input type="checkbox" value="remember-me"> Remember me
                  </label>
              </div>
          <button class="btn btn-lg btn-primary btn-block mb-4" id="login" type="submit">Masuk</button>
        </div>
        
        <div class="dropdown">
          <p class="h6">Belum ada akun?</p>
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Daftar</button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
             <a class="dropdown-item" href="<?php echo base_url('owner/signup'); ?>">Owner</a>
             <a class="dropdown-item" href="<?php echo base_url('kontraktor/signup'); ?>">Contractor</a>
         </div>
        </div>
        <p class="mt-5 mb-2 text-muted">&copy; 2019-2020 projek KP kami elee</p>
      </main>
      <script>
            $(document).ready(function() { 
            var unique_user;
            var valid_user;

            $('#login').on('click', function(){
            username = $('#inputusername').val();
            password = $('#inputPassword').val();
            
            unique_user = false;
            valid_user = false;

            let data = {
                username : username,
                password : password
            }
            // send. data to user table - expect. data from owner/pengawas/kontraktor table
            $.ajax({
                url: "<?php echo base_url('api/Login'); ?>",
                method : 'POST',
                data : data,
                success: function(response)
                {
                    var responsejs = response.data[0];
                    var id = responsejs.id;
                    var nama = responsejs.nama;
                    var role = responsejs.role;

                    if(response.data.length <= 1){
                        unique_user = true
                    }

                    if( !(id == '') || !(nama == '') || !(role == '') ){
                        valid_user = true;
                    }

                    if(unique_user && valid_user){
                        var user = JSON.stringify(responsejs);
                        if (role == 'owner')
                        {
                            // send. data owner to session function
                            $.ajax({
                                url: "<?php echo base_url('user_session'); ?>",
                                method : 'POST',
                                data : {user : user},
                                success: function()
                                {
                                    // send. owner id to proyek table - expect. all proyek related to owner id from proyek table
                                    $.ajax({
                                        url: "<?php echo base_url('api/Proyek/proyek_byowner'); ?>",
                                        method : 'POST',
                                        data : {ownerID : id},
                                        success: function(responseProyek)
                                        {
                                            var proyek = JSON.stringify(responseProyek.data);
                                            // send. proyek data to owner board
                                            $.ajax({
                                                url: "<?php echo base_url('contractor/owner_board'); ?>",
                                                method : 'POST',
                                                data : {proyek : proyek}
                                            });
                                        }
                                    });

                                    // expect. all kontraktor from kontraktor table
                                    $.ajax({
                                        url: "<?php echo base_url('api/Users/kontraktorall'); ?>",
                                        method : 'GET',
                                        success: function(responseKontraktor)
                                        {
                                            var kontraktor = JSON.stringify(responseKontraktor.data);
                                            // send. kontraktor data to owner board
                                            $.ajax({
                                                url: "<?php echo base_url('contractor/owner_board'); ?>",
                                                method : 'POST',
                                                data : {kontraktor : kontraktor}
                                            });
                                        }
                                    });

                                    // send. owner id to pengawas table - expect. all pengawas related to owner id from pengawas table
                                    $.ajax({
                                        url: "<?php echo base_url('api/Users/pengawas_byowner'); ?>",
                                        method : 'POST',
                                        data : {ownerID : id},
                                        success: function(responsePengawas)
                                        {
                                            var pengawas = JSON.stringify(responsePengawas.data);
                                            // send. pengawas data to owner board
                                            $.ajax({
                                                url: "<?php echo base_url('contractor/owner_board'); ?>",
                                                method : 'POST',
                                                data : {pengawas : pengawas}
                                            });
                                        }
                                    });

                                    window.location.href="<?php echo base_url('owner/dashboard'); ?>";
                                }
                            });
                        }

                        else if (role == 'kontraktor') 
                        {
                            // send. data kontraktor to session function
                            $.ajax({
                            url: "<?php echo base_url('user_session'); ?>",
                            method : 'POST',
                            data : {user : user},
                            success: function()
                            {
                                // send. kontraktor id to proyek table - expect. all proyek related to kontraktor id from proyek table
                                $.ajax({
                                    url: "<?php echo base_url('api/Proyek/proyek_bykontraktor'); ?>",
                                    method : 'POST',
                                    data : {kontraktorID : id},
                                    success: function(responseProyek)
                                    {
                                        var proyek = JSON.stringify(responseProyek.data);
                                        // send. proyek data to kontraktor board
                                        $.ajax({
                                            url: "<?php echo base_url('contractor/kontraktor_board'); ?>",
                                            method : 'POST',
                                            data : {proyek : proyek}
                                        });
                                    }
                                });

                                window.location.href="<?php echo base_url('kontraktor/dashboard'); ?>";
                            }
                            });
                        }

                        else if (role == 'pengawas')
                        {
                            // send. data pengawas to session function
                            $.ajax({
                            url: "<?php echo base_url('user_session'); ?>",
                            method : 'POST',
                            data : {user : user},
                            success: function()
                            {
                                // send. pengawas id to proyek table
                                // expect. all proyek related to pengawas id from proyek table
                                $.ajax({
                                    url: "<?php echo base_url('api/Proyek/proyek_bypengawas'); ?>",
                                    method : 'POST',
                                    data : {pengawasID : id},
                                    success: function(responseProyek)
                                    {
                                        var proyek = JSON.stringify(responseProyek.data);
                                        // send. proyek data to pengawas board
                                        $.ajax({
                                            url: "<?php echo base_url('contractor/pengawas_board'); ?>",
                                            method : 'POST',
                                            data : {proyek : proyek}
                                        });
                                    }
                                });
                                // expect. all kontraktor from kontraktor table
                                $.ajax({
                                    url: "<?php echo base_url('api/Users/kontraktorall'); ?>",
                                    method : 'GET',
                                    success: function(responseKontraktor)
                                    {
                                        var kontraktor = JSON.stringify(responseKontraktor.data);
                                        // send. kontraktor data to pengawas board
                                        $.ajax({
                                            url: "<?php echo base_url('contractor/pengawas_board'); ?>",
                                            method : 'POST',
                                            data : {kontraktor : kontraktor}
                                        });
                                    }
                                });

                                window.location.href="<?php echo base_url('pengawas/dashboard'); ?>";
                            }
                            });
                        }
                    }

                    else {
                        $('.alert').fadeIn();
                    }
                },
                error: function(){
                    $('.alert').fadeIn();
                }
            });
        });
    });
      </script>
      </div>
  </body>
</html>