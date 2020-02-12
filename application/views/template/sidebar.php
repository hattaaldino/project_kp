<?php
  $user_type = $this->uri->segment('1');
  $current_sidebar = $this->uri->segment('2');
?>
<nav class="col-md-2 d-none d-md-block sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?php echo $current_sidebar == 'dashboard' ? 'active' : '' ?>" href= "<?php echo base_url($user_type . '/dashboard'); ?>" > 
              <span id="project-tab"></span>
              Project
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $current_sidebar == 'profil' ? 'active' : '' ?>" href= "<?php echo base_url($user_type . '/profil'); ?>">
              <span id="profile-tab"></span>
              Profile
            </a>
        </ul>
      </div>
</nav>