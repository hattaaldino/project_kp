<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="content">
          <div class="row">
            <div class="col-md-5 text-center pt-4">
              <div class="profil mb-3">
                <?php if($user['profile']): ?>
                    <img src="<?php echo $user['profile']; ?>" width="100%">
                  <?php else: ?>
                    <img src="https://www.sackettwaconia.com/wp-content/uploads/default-profile.png" width="100%">
                  <?php endif; ?>
                <div class="container">
                  <p class="lead mt-3 mb-0">Nama Owner</p>
                  <p class="text-muted">username</p>
                </div>
              </div>
              <div>
                <a type="button" class="btn btn-sm btn-info mt-2" href="<?php echo base_url('owner/profil/edit-profil'); ?>">Edit Profil</a>
              </div>
            </div>  
            <div class="col-md-7 pt-4">
                <div>
                  <p class="mb-0"><strong>Nama</strong></p>
                  <?php if($user['nama']): ?>
                    <p><?php echo $user['nama']; ?></p>
                  <?php else: ?>
                    <p class="text-muted">Anda Belum Mendaftarkan Nama Anda</p>
                  <?php endif; ?>  
                </div>
                <div>
                  <p class="mb-0"><strong>Username</strong></p>
                  <?php if($user['username']): ?>
                    <p><?php echo $user['username']; ?></p>
                  <?php else: ?>
                    <p class="text-muted">Anda Belum Mendaftarkan Username Anda</p>
                  <?php endif; ?>
                </div>
                <div>
                  <p class="mb-0"><strong>Role</strong></p>
                  <?php if($user['role']): ?>
                    <p><?php echo $user['role']; ?></p>
                  <?php else: ?>
                    <p class="text-muted">Anda Belum Mendaftarkan Role Anda</p>
                  <?php endif; ?>
                </div>
                <div>
                  <p class="mb-0"><strong>Alamat</strong></p>
                  <?php if($user['alamat']): ?>
                    <p><?php echo $user['alamat']; ?></p>
                  <?php else: ?>
                    <p class="text-muted">Anda Belum Mendaftarkan Alamat Anda</p>
                  <?php endif; ?>
                </div>
                <div>
                  <p class="mb-0"><strong>Nomor Telepon</strong></p>
                  <?php if($user['telepon']): ?>
                    <p><?php echo $user['telepon']; ?></p>
                  <?php else: ?>
                    <p class="text-muted">Anda Belum Mendaftarkan Nomor Telepon Anda</p>
                  <?php endif; ?>
                </div>   
            </div>
          </div>
        </div>
      </main> 
    </div>
  </div>
</body>
</html>
