<script>
  var pengawas;
    <?php if(isset($pengawas)): ?>
      pengawas = JSON.parse('<?php echo json_encode($pengawas); ?>');
    <?php else: ?>
      $('#errorPageDialog').modal('show');
    <?php endif; ?> 
  </script>     
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="content">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h3">Edit Data Akun</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button id="konfirmasi-perubahan-profil" class="btn btn-sm btn-outline-secondary">Simpan Semua Perubahan</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 text-center pt-4">
              <div class="profil mb-3">
                <?php if($pengawas['profile']): ?>
                    <img id="userProfile" src="<?php echo $pengawas['profile']; ?>" width="100%">
                  <?php else: ?>
                    <img id="userProfile" src="https://www.sackettwaconia.com/wp-content/uploads/default-profile.png" width="100%">
                  <?php endif; ?>
                <div class="container">
                  <button class="edit-foto" data-toggle="modal" data-target="#editFotoModal">Edit Foto Profil</button>
                </div>
              </div>
            </div>  
            <div class="col-md-6 pt-4">
              <div>
                <div>
                  <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Nama</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editNamaModal">Edit</button>
                  </div>  
                  <?php if($pengawas['nama']): ?>
                    <p id="namaUser"><?php echo $pengawas['nama']; ?></p>
                  <?php else: ?>
                    <p id="namaUser" class="text-muted">Anda Belum Mendaftarkan Nama Anda</p>
                  <?php endif; ?>  
                </div>
                <div>
                  <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Username</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editUsernameModal">Edit</button>
                  </div> 
                  <?php if($pengawas['username']): ?>
                    <p id="username"><?php echo $pengawas['username']; ?></p>
                  <?php else: ?>
                    <p id="username" class="text-muted">Anda Belum Mendaftarkan Username Anda</p>
                  <?php endif; ?>
                </div>
                <div>
                  <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Password</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editPassModal">Edit</button>
                  </div> 
                  <?php if($pengawas['password']): ?>
                    <p id="password"><?php echo $pengawas['Password']; ?></p>
                  <?php else: ?>
                    <p id="password" class="text-muted">Anda Belum Mendaftarkan Password Anda</p>
                  <?php endif; ?>
                </div>
                <div>
                  <p class="mb-0"><strong>Role</strong></p>
                  <?php if($pengawas['role']): ?>
                    <p><?php echo $pengawas['role']; ?></p>
                  <?php else: ?>
                    <p class="text-muted">Anda Belum Mendaftarkan Role Anda</p>
                  <?php endif; ?>
                </div>
                <div>
                  <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Alamat</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editAlamatModal">Edit</button>
                  </div> 
                  <?php if($pengawas['alamat']): ?>
                    <p id="alamatUser"><?php echo $pengawas['alamat']; ?></p>
                  <?php else: ?>
                    <p id="alamatUser" class="text-muted">Anda Belum Mendaftarkan Alamat Anda</p>
                  <?php endif; ?>
                </div>
                <div>
                  <div class="d-flex flex-wrap flex-md-nowrap align-items-center">  
                    <p class="mb-0 pr-1"><strong>Nomor Telepon</strong></p>
                    <button class="edit-data-profil" data-toggle="modal" data-target="#editTelpModal">Edit</button>
                  </div> 
                  <?php if($pengawas['telepon']): ?>
                    <p id="telpUser"><?php echo $pengawas['telepon']; ?></p>
                  <?php else: ?>
                    <p id="telpUser" class="text-muted">Anda Belum Mendaftarkan Nomor Telepon Anda</p>
                  <?php endif; ?>
                </div>   
              </div>
            </div>
          </div>
        </div>
      </main> 
    </div>
  </div>
<script>
  $(document).ready(function(){
    $('input#edit-foto-profil').on('change', function(){
      var file = $('input#edit-foto-profil').prop('files')[0];
      $('label#edit-foto-profil').text(file.name);
    });
    $('input.telepon').on('change', function(){
      const telpVerification = /\+?[0-9]{5,6}[-\s]?[0-9]{5}[-\s]?[0-9]{5,6}/i;
      var nomor = $('input.telepon').val();
      if(telpVerification.test(nomor)){
        $('.telp-alert').fadeIn();
      }
      else {
        $('.telp-alert').fadeOut();
      }
    });
    $('#edit-foto').on('click', function(){
      var profilbaru = $('input#edit-foto-profil').prop('files')[0];
      if(profilbaru){
        const imageVerification = /\.(jpe?g|png)/i;
        if(imageVerification.test(profilbaru.name)){
          var reader = new FileReader();
          reader.onload = (function(){
            $('#userProfile').prop('src', reader.result);
            $('#userProfile').prop('width', '200');
            $('#userProfile').prop('height', '200');
            pengawas.profile = reader.result;
          });
          reader.readAsDataURL(profilbaru);
          $('.profile-alert').fadeOut();
          $('#editFotoModal').modal('hide');
        } else {
            $('.profile-alert').fadeIn();
        }
      }
    });

    $('#edit-nama').on('click', function(){
      var namaBaru = $('input.nama').val();
      if(namaBaru){
        pengawas.nama = namaBaru;
        $('p#namaUser').html(namaBaru);
        $('p#namaUser').removeClass('text-muted');
      }
      $('#editNamaModal').modal('hide');
    });


    $('#edit-username').on('click', function(){
      var usernameBaru = $('input.username').val();
      if(usernameBaru){
        pengawas.username = usernameBaru;
        $('p#username').html(usernameBaru);
        $('p#username').removeClass('text-muted');
      }
      $('#editUsernameModal').modal('hide');
    });

    $('#edit-pass').on('click', function(){
      var passwordBaru = $('input.password').val();
      if(passwordBaru){
        pengawas.password = passwordBaru;
        $('p#password').html(passwordBaru);
        $('p#password').removeClass('text-muted');
      }
      $('#editPassModal').modal('hide');
    });

    $('#edit-alamat').on('click', function(){
      var alamatBaru = $('textarea.alamat').val();
      if(alamatBaru){
        pengawas.alamat = alamatBaru;
        $('p#alamatUser').html(alamatBaru);
        $('p#alamatUser').removeClass('text-muted');
      }
      $('#editAlamatModal').modal('hide');
    });

    $('#edit-telp').on('click', function(){
      var telpBaru = $('input.telepon').val();
      if(telpBaru){
        pengawas.telepon = telpBaru;
        $('p#telpUser').html(telpBaru);
        $('p#telpUser').removeClass('text-muted');
      }
      $('#editTelpModal').modal('hide');
    });
    $('#konfirmasi-perubahan-profil').on('click', function(){
      if(pengawas.id){
        
        let updatePengawas = {
            id : pengawas.id,
            nama : pengawas.nama,
            username : pengawas.username,
            password : pengawas.password,
            role : pengawas.role,
            alamat : pengawas.alamat,
            telepon : pengawas.telepon,
            profile : pengawas.profile
          }
        // send. data pengawas to pengawas table
        // update. pengawas
        // expect. all pengawas from this owner (use user id)
        $.ajax({
          url : "<?php echo base_url('api/Users/edit_pengawas'); ?>",
          method : 'POST',
          data : updatePengawas,
          success : function(responsePengawas){
            var Pengawas = JSON.stringify(responsePengawas.data);

            //send. Pengawas to owner_board
            $.ajax({
              url: "<?php echo base_url('contractor/owner_board'); ?>",
              method : 'POST',
              data : {pengawas : Pengawas}
            });
          }
        });
      }
    });
  });


</script>
</body>
</html>
