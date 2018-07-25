<body class=" light-blue lighten-1">
         
   
  
        <div class="container light-blue lighten-1">
<script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>
<div class="row obum-margin-top">
    <div class="col s12 m6 push-m3">
      <div class="card white ">
        <div class="card-content">
          <span class="card-title center-align">Login</span>
             <?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('User', array('url'=>['controller'=>'telegrams','action'=>'login'],'class' => '','id' => '')); ?>
        
    
            
        <div class="input-field col s12" >
            <label for='username' >E-mail address</label>
            <input required id='username' type='text' name="data[User][username]"/>
        </div>
        <div class="input-field col s12">
            <label for='password' class=''>Password</label>
            
            <input required id='password' type='password' class='' name="data[User][password]"/>
        </div>
        
<!--    
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
        <div class='center-align'>
            <button class="waves-effect waves-light btn orange" type='submit'>Login</button>
            <hr>
        </div>
            <div>
                <span class=''>New to Spinner? <a href="<?= SITEPATH.'register'; ?>">Register</a> here.</span>
            </div>
            <div>
                <span class=''>Forgot your password? <a href='<?= SITEPATH.'telegrams/resetpassword'?>'>Reset</a> it here.</span>
            </div>

            <?php echo $this->form->end(); ?>
          </div>
        </div>
    </div>
    </div>
    </div>
     <?php echo $this->Html->script('jquery.js');?>
     <?php echo $this->Html->script('materialize.min.js');?>
     <?php echo $this->Html->script('resend.js');?>
     
     
     
     
     <?php echo $this->Html->css('font-awesome.min.css');?>
<?php echo $this->Html->css('main.css');?>
<?php echo $this->Html->css('new_section.css');?>


<a href="<?= SITEPATH.'register';?>">Register</a>
<a href="<?= SITEPATH.'login';?>">Login</a>



<body class="Home">
<!-- Header -->
    <header>
        <nav>
            <span class="navbar-bg"></span>
            <div id="mobile-toggle">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="col-md-4 col-xs-12 brand">
                <a href="https://getcryptostorm.com/"><span class="logo"></span>BitcoinThief Bot</a>
            </div>
            <div class="col-md-8 col-xs-12 nav-links">
                <a href="https://getcryptostorm.com/guide">User Guide</a>
                <a href="https://getcryptostorm.com/faq">FAQ</a>
                <a href="https://getcryptostorm.com/support">Support</a>
                <a id="demo" href="<?= SITEPATH.'login';?>">Login</a>
                <a id="buy" class="button" href="<?= SITEPATH.'register';?>">Register</a>
            </div>
        </nav>
    </header>
<!-- End header -->
<!-- Page Content -->
    <section class="page-header">
        <div class="container">
            <div class="col-md-6">
                <div class="announcement"><span class="new-pill">New!</span>Improved Volume Breakout Indicator!</div>
                <h1>Your official, 100% cloud-based speed trading assistant</h1>
                <h2>The fastest, simplest and most safe interface for short-term trading on <strong>Bittrex, Binance</strong> and <strong>Cryptopia</strong> - from manual trades to pump and dumps.</h2>
                <form class="lead-gen" action="https://getcryptostorm.us17.list-manage.com/subscribe/post?u=1dd61c9c6c3130f04961e5496&amp;id=7a0aa9708f" method="post" target="_blank" novalidate>
                <input placeholder="Enter your email address..." name="EMAIL" type="text">
                <button class="button" type="submit">Subscribe</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="screenshot"></div>
            </div>
        </div>
    </section>
<section id="Features">
<div class="container">
<h3>Features</h3>
<h4>A complete solution made by crypto traders, for crypto traders</h4>
<ul>
<div class="row">
<div class="col-md-12">
<li class="col-md-4 col-sm-6">
<i class="fa fa-list-ol" aria-hidden="true"></i>
<div>
<span class="feature-title">High potential coins</span>
<span class="feature-desc">Get a glimpse of which coins have shallow order books and thus more potential to moon in the short run.</span>
</div>
</li>
<li class="col-md-4 col-sm-6">
<i class="fa fa-line-chart" aria-hidden="true"></i>
<div>
<span class="feature-title">Volume based signals</span>
<span class="feature-desc"><strong>(Prepump detector)</strong> Get real time signals when a coin's volume change indicates a possible rise or dip.</span>
</div>
</li>
<li class="col-md-4 col-sm-6">
<i class="fa fa-star" aria-hidden="true"></i>
<div>
<span class="feature-title">Bookmarks</span>
<span class="feature-desc">Stay on top of your trades by bookmarking coins you want to monitor.</span>
</div>
</li>
</div>
<div class="col-md-12">
<li class="col-md-4 col-sm-6">
<i class="fa fa-shield" aria-hidden="true"></i>
<div>
<span class="feature-title">Safe</span>
<span class="feature-desc">Exchange keys never leave your computer and are only used to place your buys and sells.</span>
</div>
</li>
<li class="col-md-4 col-sm-6">
<i class="fa fa-bar-chart" aria-hidden="true"></i>
<div>
<span class="feature-title">Live updating charts</span>
<span class="feature-desc">Monitor your buy and sell orders on the second-by-second price chart.</span>
</div>
</li>
<li class="col-md-4 col-sm-6">
<i class="fa fa-btc" aria-hidden="true"></i>
<div>
<span class="feature-title">Solid and profitable</span>
<span class="feature-desc">Tested and proven successful over thousands of trades.</span>
</div>
</li>
</div>
<div class="col-md-12">
<li class="col-md-4 col-sm-6">
<i class="fa fa-tasks" aria-hidden="true"></i>
<div>
<span class="feature-title">Multiple buy &amp; sell points</span>
<span class="feature-desc">You can choose to automatically buy and sell at custom profit margins.</span>
</div>
</li>
<li class="col-md-4 col-sm-6">
<i class="fa fa-book" aria-hidden="true"></i>
<div>
<span class="feature-title">Real time overview</span>
<span class="feature-desc">See your open and closed books without having to login on the Exchange.</span>
</div>
</li>
<li class="col-md-4 col-sm-6">
<i class="fa fa-bolt" aria-hidden="true"></i>
<div>
<span class="feature-title">Blazing Fast</span>
<span class="feature-desc">We use websockets to stream current prices in real time, so we can put in your orders instantly.</span>
</div>
</li>
</div>
</div>
</ul>
<div class="center">
<a class="button wide" href="https://getcryptostorm.com/guide">View User Guide</a>
</div>
</div>
</section>




<!---SECTION godly-signals ----->
<section class="godly-signals">
	<div class="container">				
		
		<p class="LgSUBTITLE style1">* LOREM IPSUM DOLOR SIT AMET *</p>
        
    <!---coolBox----->            
	<div class="coolBox"> 
		<p class="LgSIMPLE">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
 
		<p>                             
            <ol class="LgLISTS">
                <li>the date you purchased my subscription off my site</li>
                <li>the blockchain transaction batch / code from the purchase of the subs on my site </li>
                <li>(looks like this <!--https://blockchain.info/tx/aac6d02c994978fd25be67a6c97ab39ecc90322e1e10e4e7749e79d0740edcdd-->https://bit.ly/2sIrxKE) </li> 
                <li>OR the btc wallet address that you sent the payment for my product</li>
                <li>or your username on any darknet market i'm selling if you purchased from there OK ? </li>
                <li>and we will give you guys the invite to the room IMMEDIATELY</li>
            </ol> 
		</p>
 

		<p class="LgSIMPLE">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

	<div align="center" class="LgButtonBUY"><a class="btn-buy" href="#">BUTTON TYPE HERE</a><br><br></div>




		<p align="center">&nbsp;</p>
                                                               
		<p class="LgSUBTITLE">* A KIND OF A SUBTITLE HERE IF NEEDED *</p>                             
                            
		<p align="center">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX EA COMMODO CONSEQUAT.</p>

		<a href="#" target="_blank"><?php echo $this->Html->image('PictureSymbol_Big.jpg',['class'=>'img-responsive centerImages','id'=>'','alt'=>'']); ?></a>

		<p align="center">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX EA COMMODO CONSEQUAT.</p>

		<a href="#" target="_blank"><img src="CryptoStorm/images/PictureSymbol_Small.jpg" alt="" class="img-responsive centerImages"></a>


		<p align="center">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX EA COMMODO CONSEQUAT</p>

		<p align="center">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT</p>


		<p align="center"> PROOFS BELOW </p> 

		<a href="#" target="_blank"><img src="CryptoStorm/images/PictureSymbol_Big.jpg" alt="" class="img-responsive centerImages"></a>
		<a href="#" target="_blank"><img src="CryptoStorm/images/PictureSymbol_Big.jpg" alt="" class="img-responsive centerImages"></a>
        

		<p align="center">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX EA COMMODO CONSEQUAT.</p>

		<div class="aspect-ratio" style="margin:30px auto;" align="center"><iframe  width="560" height="315" src="https://www.youtube.com/embed/SJzO83A3IY4?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe> </div>

		<div class="aspect-ratio" style="margin:30px auto;" align="center"><iframe width="560" height="315" src="https://www.youtube.com/embed/-qB8Cr4vCUg?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe></div>

  

<p align="center">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT, SED DO EIUSMOD TEMPOR INCIDIDUNT UT LABORE ET DOLORE MAGNA ALIQUA. UT ENIM AD MINIM VENIAM, QUIS NOSTRUD EXERCITATION ULLAMCO LABORIS NISI UT ALIQUIP EX EA COMMODO CONSEQUAT.</p>

<p align="center">JOIN US AND BECOME A PLAYER LIKE US !</p>

<p align="center">Thanks, BitcoinThief Team.  </p>


		<div align="center" class="LgButtonBUY"><a class="btn-buy" href="#">BUTTON TYPE HERE</a><br><br></div>

    	</div><!------END coolBox------>
	</div><!------END container--------->                             
</section><!------END SECTION godly-signals ---------->



<section id="Exchanges" class="alt-background">
<div class="container">
<h3>Supported exchanges</h3>
<span class="exchange bittrex"></span>
<span class="exchange binance"></span>
<span class="exchange cryptopia"></span>
</div>
</section>
<section id="Pricing">
<div class="container">
<h3>Pricing</h3>
<h4>No nonsense, one pricing option</h4>
<div class="row">
<div class="col-md-3 col-sm-4 col-md-offset-3 col-sm-offset-2 pricing-box">
<p>0.04 BTC</p>
<p>Lifetime license</p>
</div>
<div class="col-sm-6 pricing-details">
<ul>
<li><i class="fa fa-check" aria-hidden="true"></i> Lifetime updates and support</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Unlock all supported exchanges</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Use on 1 machine</li>
<li><i class="fa fa-check" aria-hidden="true"></i> Easy installation</li>
<li><i class="fa fa-check" aria-hidden="true"></i> OS: Mac / Windows / Linux</li>
</ul>
</div>
</div>
<div class="center">
<a class="button wide" href="https://getcryptostorm.com/buy">Buy now</a>
</div>
</div>
</section>
<section class="alt-background-dark banner">
<div class="container">
<div class="col-md-8">
<h3>Ready to get started?</h3>
<span>Buy your copy of CryptoStorm today.</span>
</div>
<div class="col-md-4">
<a class="button" id="buyBanner" href="https://getcryptostorm.com/buy">Buy now</a>
<a class="button light" id="demoBanner" href="https://getcryptostorm.com/trial">Free Trial</a>
</div>
</div>
</section><!-- End page content -->
<!-- Footer -->
<div class="footer-wrapper">
<div id="Contact">
<div class="container">
<p>Questions or comments? Join our Discord community! <a href="https://discord.gg/vQKjaxh" target="_blank">https://discord.gg/r3xvED9</a></p>
</div>
</div>
<footer>
<div class="container">
<div class="col-xs-12 social-links">
<div class="link">
<a href="http://t.me/cryptostorm" target="_blank"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
</div>
<div class="link">
<a href="https://www.youtube.com/channel/UCeJtxSj2Tre_02CDw_bq31Q" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
</div>
<div class="link">
<a href="https://twitter.com/CryptoStormBot" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
</div>
<div class="link">
<a href="https://bitcointalk.org/index.php?topic=2061680.0" target="_blank"><i class="fa fa-btc" aria-hidden="true"></i></a>
</div>
</div>
<div class="col-xs-12 sub-links centered-h">
<a href="https://getcryptostorm.com/affiliate">Affiliate Program</a>
<a href="https://getcryptostorm.com/terms">Terms &amp; Conditions</a>
<a href="https://getcryptostorm.com/privacy-policy">Privacy Policy</a>
</div>
<p>© 2018 CryptoStorm. All Rights Reserved.</p>
</div>
</footer>
</div>
<!-- End footer -->
<!-- Scripts -->

<?php echo $this->Html->script('axios.js');?>
<?php echo $this->Html->script('klukt.js');?>
<?php echo $this->Html->script('main.js');?>
<!-- End scripts -->

</body>
</body>