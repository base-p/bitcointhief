<a href="<?= SITEPATH.'account';?>">My Account</a>

<<<<<<< HEAD
<a href="<?= SITEPATH.'logout';?>">LOGOUT</a>
=======
<a href="<?= SITEPATH.'telegrams/panicsell/';?>">Panic Sell</a>
>>>>>>> e22a1c2fad969af46b596af93a5b8a278c6b10b1


<body class=" light-blue lighten-1">
         
   
  
        <div class="container light-blue lighten-1">
<script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>
<div class="row obum-margin-top">
    <div class="col s12 m6 push-m3">
      <div class="card white ">
        <div class="card-content">
          <span class="card-title center-align">Dashboard</span>
             <?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('Option', array('url'=>['controller'=>'telegrams','action'=>'dashboard'],'class' => '','id' => '')); ?>
        
    
         <div class="input-field col s12" >
            <label for='exchange' >Select Exchange</label>
            <select class="password" name="data[account_id]" id="exchange" required>
              <option value="" >Select Account...</option>
              <?php foreach($options as $option){ ?>
             <option value="<?php echo $option['Option']['id'];?>"><?php echo $option['Exchange']['exchange_name'];?></option>
             <?php } ?>
             </select>
        </div>   
        <div class="input-field col s12" >
            <label for='signal' >Signal Symbol(In CAPS E.g. DGB)</label>
            <input required id='signal' type='text' name="data[signal]"/>
        </div>
        <div class="input-field col s12">
            <label for='amount' class=''>BTC Amount to commit(Optional if setup in my account)</label>
            
            <input id='amount' type='text' class='' name="data[btc_amount]"/>
        </div>        
        
<!--    
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
        <div class='center-align'>
            <button class="waves-effect waves-light btn orange" type='submit'>Enter Pump</button>
            <hr>
        </div>

            <?php echo $this->form->end(); ?>
          </div>
          
        </div>
    </div>
    </div>
<<<<<<< HEAD
    <h1>Active</h1>
=======
    <h1>Active Pumps</h1>
>>>>>>> e22a1c2fad969af46b596af93a5b8a278c6b10b1
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>TRADEPAIR</th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<<<<<<< HEAD
                    <?php foreach($active_pumps as $active_pump){ ?>
                    <tr>
                        <td><?= $active_pump['Pump']['id']; ?></td>
                        <td><?= $active_pump['Option']['Exchange']['exchange_name']; ?></td>
                        <td><?= $active_pump['Pump']['pair']; ?></td>
                        <td><?= $active_pump['Pump']['created']; ?></td>
                        <td><?= $active_pump['Pump']['active']; ?></td>
                        
                        <td><a href="<?= SITEPATH.'/telegrams/editoption/'.$active_pump['Pump']['id'] ; ?>">Edit</a></td>
                    </tr>
                   <?php } ?> 
                </tbody>
                <!--<tfoot>
                <tr>
                    <td colspan='4'>
                        <?php echo $this->element('paging_links'); ?>
                        <p>Total number of transactions: <?= $total ?>.</p>
                    </td>
                </tr>
                </tfoot>-->
            </table>
            
            <h1>Completed</h1>
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>TRADEPAIR</th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($history_pumps as $active_pump){ ?>
                    <tr>
                        <td><?= $active_pump['Pump']['id']; ?></td>
                        <td><?= $active_pump['Option']['Exchange']['exchange_name']; ?></td>
                        <td><?= $active_pump['Pump']['pair']; ?></td>
                        <td><?= $active_pump['Pump']['created']; ?></td>
                        <td><?= $active_pump['Pump']['active']; ?></td>
                        
                        <td><a href="<?= SITEPATH.'/telegrams/editoption/'.$active_pump['Pump']['id'] ; ?>">Edit</a></td>
                    </tr>
                   <?php } ?> 
                </tbody>
                <!--<tfoot>
                <tr>
                    <td colspan='4'>
                        <?php echo $this->element('paging_links'); ?>
                        <p>Total number of transactions: <?= $total ?>.</p>
                    </td>
                </tr>
                </tfoot>-->
            </table>
            
             <h1>Panics</h1>
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>TRADEPAIR</th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($panic_pumps as $active_pump){ ?>
                    <tr>
                        <td><?= $active_pump['Pump']['id']; ?></td>
                        <td><?= $active_pump['Option']['Exchange']['exchange_name']; ?></td>
                        <td><?= $active_pump['Pump']['pair']; ?></td>
                        <td><?= $active_pump['Pump']['created']; ?></td>
                        <td><?= $active_pump['Pump']['active']; ?></td>
                        
                        <td><a href="<?= SITEPATH.'/telegrams/editoption/'.$active_pump['Pump']['id'] ; ?>">Edit</a></td>
                    </tr>
                   <?php } ?> 
                </tbody>
                <!--<tfoot>
                <tr>
                    <td colspan='4'>
                        <?php echo $this->element('paging_links'); ?>
                        <p>Total number of transactions: <?= $total ?>.</p>
                    </td>
                </tr>
                </tfoot>-->
            </table>
            
             <h1>Cancelled</h1>
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>TRADEPAIR</th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cancelled_pumps as $active_pump){ ?>
                    <tr>
                        <td><?= $active_pump['Pump']['id']; ?></td>
                        <td><?= $active_pump['Option']['Exchange']['exchange_name']; ?></td>
                        <td><?= $active_pump['Pump']['pair']; ?></td>
                        <td><?= $active_pump['Pump']['created']; ?></td>
                        <td><?= $active_pump['Pump']['active']; ?></td>
                        
                        <td><a href="<?= SITEPATH.'/telegrams/editoption/'.$active_pump['Pump']['id'] ; ?>">Edit</a></td>
=======
                    <?php foreach($options as $option){ ?>
                    <tr>
                        <td><?= $option['Option']['id']; ?></td>
                        <td><?= $option['Exchange']['exchange_name']; ?></td>
                        <td><?= $option['Option']['api_key']; ?></td>
                        <td><?= $option['Option']['api_secret']; ?></td>
                        <td><?= $option['Option']['balance']; ?></td>
                        <td><?= $option['Option']['profit_level']; ?></td>
                        <td><?= $option['Option']['commit_amount']; ?></td>
                        <td><a href="<?= SITEPATH.'/telegrams/editoption/'.$option['Option']['id'] ; ?>">Edit</a></td>
>>>>>>> e22a1c2fad969af46b596af93a5b8a278c6b10b1
                    </tr>
                   <?php } ?> 
                </tbody>
                <!--<tfoot>
                <tr>
                    <td colspan='4'>
                        <?php echo $this->element('paging_links'); ?>
                        <p>Total number of transactions: <?= $total ?>.</p>
                    </td>
                </tr>
                </tfoot>-->
            </table>
    </div>
     <?php echo $this->Html->script('jquery.js');?>
     <?php echo $this->Html->script('materialize.min.js');?>
     <?php echo $this->Html->script('resend.js');?>
</body>