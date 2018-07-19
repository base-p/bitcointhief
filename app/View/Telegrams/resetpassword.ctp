 <body class=" light-blue lighten-1">
      <div class="container light-blue lighten-1">
     <script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>
<div class="row obum-margin-top">
    <div class="col s12 m6 push-m3">
      <div class="card white ">
        <div class="card-content">
          <span class="card-title center-align">Reset Password</span>
<?php echo $this->Form->create('User', array('url'=>['controller'=>'telegrams','action'=>'resetpassword'],'class' => '','id' => '')); ?>
     <?php echo $this->Session->flash(); ?>
        <div class="input-field col s12">
            <label for='username' >E-mail address</label>
            <input required id='username' type='text' name="data[email]"/>
        </div>
        
<!--
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
        <div class='center-align'>
            <button class="waves-effect waves-light btn orange" type='submit'>Reset</button>
        </div>
            
<?php echo $this->form->end(); ?>
          </div>
        </div>
    </div>
          </div>
     </div>
     
       <?php echo $this->Html->script('materialize.min.js');?>
</body>