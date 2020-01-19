<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Signin Scafol</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_login.css" >
    
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?php echo base_url();?>assets/js/login.js"></script>
    
  </head>
  <body class="text-center">
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
             <a class="dropdown-item" href="<?php echo base_url('contractor/regis_owner'); ?>">Owner</a>
             <a class="dropdown-item" href="<?php echo base_url('contractor/regis_kontraktor'); ?>">Contractor</a>
         </div>
        </div>
        <p class="mt-5 mb-2 text-muted">&copy; 2019-2020 projek KP kami elee</p>
      </main>
    </body>
</html>