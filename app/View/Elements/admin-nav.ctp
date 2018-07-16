
<div class="navbar-fixed">
<nav class="light-blue lighten-1">
    <div class="nav-wrapper ">
      <a href="/" class="brand-logo"><?= $this->Html->image('logo.png',['id'=>'','alt'=>'']); ?></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        
        <li><a href="<?= SITEPATH.'admin/spins/dashboard'; ?>">Admin Dashboard</a></li>
        <li><a href="<?= SITEPATH.'admin/spins/manageadbanner'; ?>" >Manage AdBanners</a></li>
        <li><a href="<?= SITEPATH.'admin/spins/managespinner'; ?>" >Manage Spinners</a></li>
        <li><a href="<?= SITEPATH.'admin/spins/manageusers'; ?>" >Manage Users</a></li>
        <li><a href="<?= SITEPATH.'logout'; ?>" >Logout</a>
          </li><li><a href="<?= SITEPATH.'dashboard'; ?>" >User Dashboard</a></li>
      </ul>
    </div>
  </nav>
</div>

<ul class="sidenav" id="mobile-demo">
    
    <li><a href="<?= SITEPATH.'admin/spins/dashboard'; ?>">Admin Dashboard</a></li>
    <li><a href="<?= SITEPATH.'admin/spins/manageadbanner'; ?>" >Manage AdBanners</a></li>
    <li><a href="<?= SITEPATH.'admin/spins/managespinner'; ?>" >Manage Spinners</a></li>
    <li><a href="<?= SITEPATH.'admin/spins/manageusers'; ?>" >Manage Users</a></li>
    <li><a href="<?= SITEPATH.'logout'; ?>">Logout</a></li>
    <li><a href="<?= SITEPATH.'dashboard'; ?>" >User Dashboard</a></li>
  </ul>