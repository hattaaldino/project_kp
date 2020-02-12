      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="content text-center">
            <div class="container-daftar-pengawas">
              <div class="alert alert-warning alert-dismissible " id="alert-name" style="display: none" role="alert">
                  <strong>SignUp Gagal!</strong> pastikan nama yang anda masukkan sudah sesuai.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="alert alert-warning alert-dismissible " id="alert-username" style="display: none" role="alert">
                  <strong>SignUp Gagal!</strong> pastikan username yang anda masukkan sudah sesuai.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="alert alert-warning alert-dismissible " id="alert-password" style="display: none" role="alert">
                  <strong>SignUp Gagal!</strong> pastikan password yang anda masukkan sudah sesuai.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

              <div class="needs-validation" novalidate> 
                <div class="mb-3">
                  <label for="nama">Nama*</label>
                  <div class="input-group">
                    <input type="text" name="nama" class="form-control" id="nama" autofocus required>
                    <div class="invalid-feedback nama-alert">
                      Masukan Nama terlebih dahulu.
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="username">Username/Email* <span class="text-muted"></span></label>
                  <input type="email" name="username" class="form-control" id="username" data-role="pengawas" autofocus required>
                  <div class="invalid-feedback username-alert">
                    Masukan Username yang Benar.
                  </div>
                </div>

                <div class="mb-3">
                  <label for="inputPassword">Password*</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" autofocus required >
                  <div class="invalid-feedback pass-alert">
                    Masukan Password anda
                  </div>
                </div>

                <div class="mb-3">
                  <label for="address">Alamat</label>
                  <textarea name="alamat" class="form-control" id="address"></textarea>
                </div>

                <div class="mb-3">
                  <label for="telp">No Telepon</label>
                  <input type="text" name="telepon" id="telp" class="form-control">
                  <div class="invalid-feedback telp-alert">
                    Please insert a valid phone number.
                  </div>
                </div>

                <div class="mb-4">
                  <label for="image">Foto Profile</label>
                  <input type="file" name="profile" id="image" accept=".jpg, .png, .jpeg" class="form-control" style="height:45px">
                </div>
                <div class="invalid-feedback profile-alert">
                  Your profile picture must be in image format (jpg,jpeg,png).
                </div>

                <div class="mb-3 text-small text-muted">
                  <p>Label dengan * wajib diisi</p>
                </div>

                <hr class="mb-4">
                <button class="btn btn-daftar-pengawas btn-lg btn-block" type="submit" id="daftarbtn">Daftar</button>
              </div>
            </div>
          </div>
      </main>
    </div>
  </div>
<script>
  $(document).ready(function(){
        const imageVerification = /\.(jpe?g|png)/i;
        $('#image').on('change', function(){
          let image = $(this).prop('files')[0];
          if(!(imageVerification.test(image.name))){
            $('.profile-alert').fadeIn();
            $('#image').focus();
          } else {
            $('.profile-alert').fadeOut();
          }
        });
        $('#telp').on('change', function(){
          const telpVerification = /\+?[0-9]{5,6}[-\s]?[0-9]{5}[-\s]?[0-9]{5,6}/i;
          var nomor = $('#telp').val();
          if(telpVerification.test(nomor)){
            $('.telp-alert').fadeIn();
          }
          else {
            $('.telp-alert').fadeOut();
          }
        });

        $('#daftarbtn').on('click', function(){
            var nama = $('#nama').val();
            var username = $('#username').val();
            var password = $('#inputPassword').val();
            var role = $('#username').attr('data-role');
            var alamat = $('#address').val();
            var telepon = $('#telp').val();
            var profile;
            
            var image = $('#image').prop('files')[0];
            if(image){
              var reader = new FileReader();
              reader.onload = function(){
                  profile = reader.result;
                };
              reader.readAsDataURL(image);  
            }

            if(nama == ''){
                $('#alert-name').fadeIn();
                $('.nama-alert').fadeIn();
                $('#nama').focus();
            }

            else if(username == ''){
                $('#alert-username').fadeIn();
                $('.username-alert').fadeIn();
                $('#username').focus();
            }

            else if(password.length == 0){
                $('#alert-password').fadeIn();
                $('.pass-alert').fadeIn();
                $('#inputpassword').focus();
            }
            
            else{
                let form_data = new FormData();
                form_data.append('nama', nama);
                form_data.append('username', username);
                form_data.append('password', password);
                form_data.append('role', role);
                form_data.append('alamat', alamat);
                form_data.append('telepon', telepon);
                form_data.append('profile', profile);
                
                $.ajax({
                    url: " ",
                    method: 'POST',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function(response){
                        var pengawas = response.data[0];
                        $.ajax({
                            url: "<?php echo base_url('contractor/owner_board'); ?>",
                            method : 'POST',
                            data : pengawas
                            }
                        })
                    },
                    error: function(){
                        $('#alert-username').fadeIn();
                    }
                });
            }
        });
      });
</script>
</body>
</html>