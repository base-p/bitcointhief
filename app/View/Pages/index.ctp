
<h1>Messages</h1>

<?php foreach($updates as $update){
    echo $update['Update']['message']."<br>";
 } ?>


<h1>Channel Posts</h1>


<?php foreach($updates as $update){
    echo $update['Update']['channel_post']."<br>";
 } ?>
 
 
 <h1>Manual Entry</h1> 
 
<?php echo $this->Form->create('Update', array('url'=>['controller'=>'pages','action'=>'index'],'class' => '','id' => '')); ?>
        
    
            
        <div class="input-field col s12" >
            <label for='username' >message</label>
            <input  id='username' type='text' name="data[message]"/>
        </div>
        <div class="input-field col s12">
            <label for='password' class=''>channel post</label>
            
            <input id='password' type='text' class='' name="data[channel_post]"/>
        </div>
        
<!--    
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
        <div class='center-align'>
            <button class="waves-effect waves-light btn orange" type='submit'>Login</button>
            <hr>
        </div>
            

            <?php echo $this->form->end(); ?>