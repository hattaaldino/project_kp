<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Daftar Owner</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" >

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/signup.js"></script>
 
    <style>

    .container 
    {
      max-width: 500px;
    }
    .lh-condensed 
    { 
      line-height: 1.25; 
    }
    .btn-primary {
    color: #0069d9;
    background-color: #ffffff;
    border-color: #0069d9;
    border-width: 2px;
    }
    </style>
    
  </head>
  <body class="bg-light">
    <div class="container">
      <div class="py-5 text-center">
        <img class="mb-4" src="<?php echo base_url();?>user_guide/_images/logo_main.png" height="63" width="285">
        <h2>Daftar Akun Owner</h2>
      </div>

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
            <input type="text" name="nama" class="form-control" id="nama" required>
            <div class="invalid-feedback" style="width: 100%;">
              Masukan Nama terlebih dahulu.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Username/Email* <span class="text-muted"></span></label>
          <input type="email" name="username" class="form-control" id="username" data-role="owner" required>
          <div class="invalid-feedback">
            Masukan Username yang Benar.
          </div>
        </div>

        <div class="mb-3">
          <label for="inputPassword">Password*</label>
          <input type="password" name="password" id="inputPassword" class="form-control" required >
          <div class="invalid-feedback">
            Masukan Password anda
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Alamat</label>
          <input type="text" name="alamat" class="form-control" id="address" required>
          <div class="invalid-feedback">
            Masukan Alamat
          </div>
        </div>

        <div class="mb-3">
          <label for="telp">No Telepon</label>
          <input type="text" name:"telepon" id="telp" class="form-control" required >
          <div class="invalid-feedback">
            Masukan Nomor Telepon anda
          </div>
        </div>

        <div class="mb-4">
          <label for="image">Foto Profile</label>
          <input type="file" name="profile" id="image" accept=".jpg, .png, .jpeg" class="form-control" style="height:45px" required>
          <div class="invalid-feedback">
            Masukan Foto Profile anda
          </div>
        </div>

        <div class="mb-3 text-small text-muted">
          <p>Label dengan * wajib diisi</p>
        </div>

        
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit" id="daftarbtn">Daftar</button>
      </div>
    </div>

      <div class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019-2020 Project KP</p>
      </div>


  </body>
</html>