<body class=" light-blue lighten-1">
         
   
  
        <div class="container light-blue lighten-1">
<script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>
<div class="row obum-margin-top">
    <div class="col s12 m6 push-m3">
      <div class="card white ">
        <div class="card-content">
         <a href="<?= SITEPATH.'dashboard';?>">Go to Dashboard</a>
          <span class="card-title center-align">My Account</span>
             <?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('Option', array('url'=>['controller'=>'telegrams','action'=>'account'],'class' => '','id' => '')); ?>
        
    
         <div class="input-field col s12" >
            <label for='exchange' >Select Exchange</label>
            <select class="password" name="data[Option][exchange_id]" id="exchange" required>
              <option value="" >Select Exchange...</option>
              <?php foreach($exchanges as $exchange){ ?>
             <option value="<?php echo $exchange['Exchange']['id'];?>"><?php echo $exchange['Exchange']['exchange_name'];?></option>
             <?php } ?>
             </select>
        </div>   
        <div class="input-field col s12" >
            <label for='apikey' >API Key</label>
            <input required id='apikey' type='text' name="data[Option][api_key]"/>
        </div>
        <div class="input-field col s12">
            <label for='apisecret' class=''>API Secret</label>
            
            <input required id='apisecret' type='text' class='' name="data[Option][api_secret]"/>
        </div>
        <div class="input-field col s12" >
            <label for='profitlevel' >Profit Level(in percentage E.g. 100, 10, 140 etc)</label>
            <input required id='profitlevel' type='text' name="data[Option][profit_level]"/>
        </div>
        <div class="input-field col s12" >
            <label for='commitamount' >BTC amount to commit to each Signal (in BTC, not SATS)</label>
            <input required id='commitamount' type='text' name="data[Option][commit_amount]"/>
        </div>
        
        
<!--    
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
        <div class='center-align'>
            <button class="waves-effect waves-light btn orange" type='submit'>Submit</button>
            <hr>
        </div>

            <?php echo $this->form->end(); ?>
          </div>
          
        </div>
    </div>
    </div>
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>API KEY</th>
                        <th>API SECRET</th>
                        <th>Available Balance BTC</th>
                        <th>PROFIT LEVEL</th>
                        <th>BTC PER SIGNAL </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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