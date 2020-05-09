<?php
if(session_status() == PHP_SESSION_NONE)
{
  session_start();
}
$user = $_SESSION['user'];
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Scafol</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/jumbotron/"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style_page.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.google-analytics.com/analytics.js"></script>
    <script type="text/javascript" src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.logoutButton').on('click', function(){
              window.location.href = "<?php echo base_url('login'); ?>";
            });
        });
    </script>
    <script>
      <?php if(!isset($user)): ?>
        $('#errorPageDialog').modal('show');
      <?php endif; ?>
      $(document).ready(function(){
        $('#namaHeader').html('<?php echo $user['nama']; ?>');
      });
    </script>
  </head>
  <body>
  <nav class="navbar fixed-top bg-warnaaa flex-md-nowrap p-0 shadow-sm" style="height:40px;">
      <a  href="#" ><img  src="<?php echo base_url();?>user_guide/_images/logo_main.png" height="30" width="133" class="ml-5"></a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
        <span class="lead">Hello </span>
        <span id="namaHeader" class="lead" style="margin-right:10px;"></span>
        <img role="button" title="Logout Button" src="https://pngimage.net/wp-content/uploads/2018/06/logout-png-image-1.png" height="30" width="30" data-toggle="modal" data-target="#logoutModal" style="margin-bottom: 3px;">
        </li>
      </ul>
    </nav>  
