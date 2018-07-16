
<div class="navbar-fixed">
<nav class="light-blue lighten-1">
    <div class="nav-wrapper ">
      <a href="/" class="brand-logo"><?= $this->Html->image('logo.png',['id'=>'','alt'=>'']); ?></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><div class = "valign-wrapper balance ">BALANCE <span class="new badge " data-badge-caption="Spins"><?= $spin_no; ?></span> </div></li>
        <li><div class = "valign-wrapper balance"> - <span class="new badge" data-badge-caption="Satoshis"><?= $sats; ?></span> </div></li>
        <li><a href="<?= SITEPATH.'dashboard'; ?>">Dashboard</a></li>
        <li><a href="<?= SITEPATH.'settings'; ?>">Settings</a></li>
        <li><a href="<?= SITEPATH.'shop'; ?>">Shop</a></li>
        <li><a href="<?= SITEPATH.'transactions'; ?>">Transactions</a></li>
        <li><a href="<?= SITEPATH.'logout'; ?>" style="display:block;">Logout</a></li>
        <?php  if($cUser['User']['user_type_id'] === '1'){ ?>
          <li><a href="<?= SITEPATH.'admin/spins/dashboard'; ?>" style="display:block;">Admin</a></li>
          <?php } ?>
      </ul>
    </div>
  </nav>
</div>

<ul class="sidenav" id="mobile-demo">
    <li>Spins Balance <span class="new badge green" data-badge-caption="Spins"><?= $spin_no; ?></span> </li>
    <li> Satoshi Balance<span class="new badge green" data-badge-caption="Satoshis"><?= $sats; ?></span></li>
    <li><a href="<?= SITEPATH.'dashboard'; ?>">Dashboard</a></li>
    <li><a href="<?= SITEPATH.'settings'; ?>">Settings</a></li>
    <li><a href="<?= SITEPATH.'shop'; ?>">Shop</a></li>
    <li><a href="<?= SITEPATH.'transactions'; ?>">Transactions</a></li>
    <li><a href="<?= SITEPATH.'logout'; ?>">Logout</a></li>
    <?php  if($cUser['User']['user_type_id'] === '1'){ ?>
          <li><a href="<?= SITEPATH.'admin/spins/dashboard'; ?>" style="display:block;">Admin</a></li>
          <?php } ?>
  </ul>