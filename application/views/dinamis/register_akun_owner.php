<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Checkout example · Bootstrap</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 
    <style>
    .container {
  max-width: 960px;
}
.lh-condensed { line-height: 1.25; }
    </style>
    
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
  <img class="mb-4" src="<?php echo base_url();?>user_guide/_images/logo_main.png" height="100" width="300">
    <h2>Daftar Akun Owner</h2>
    </div>
      <h4 class="mb-3">Nama Perusahaan</h4>
      <form class="needs-validation" novalidate>
        <div class="mb-3">
          <label for="username">Nama</label>
          <div class="input-group">
            <input type="text" class="form-control" id="username" placeholder="Nama" required>
            <div class="invalid-feedback" style="width: 100%;">
              Masukan Nama Perusahaan terlebih dahulu.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email Perusahaan<span class="text-muted"></span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Masukan Email yang Benar.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Alamat Perusahaan</label>
          <input type="text" class="form-control" id="address" placeholder="" required>
          <div class="invalid-feedback">
            Masukan Alamat
          </div>
        </div>

        <div class="mb-3">
          <label >Passowrd</label>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required >
          <div class="invalid-feedback">
            Masukan Password anda
          </div>
        </div>

        
        <hr class="mb-4">
        <a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url('contractor/index'); ?>">Continue to checkout</a>
      </form>
    </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017-2019 Company Name</p>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
        <script src="form-validation.js"></script>
    </body>
</html>