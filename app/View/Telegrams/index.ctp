<?php echo $this->Html->css('font-awesome.min.css');?>
<?php echo $this->Html->css('main.css');?>
<?php echo $this->Html->css('new_section.css');?>
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
                <a href="https://bitcointhief.app/"><span class="logo"></span>BitcoinThief Bot</a>
            </div>
            <div class="col-md-8 col-xs-12 nav-links">
                <a href="https://bitcointhief.app/guide">User Guide</a>
                <a href="https://bitcointhief.app/faq">FAQ</a>
                <a href="https://bitcointhief.app/support">Support</a>
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
                <div class="announcement"><span class="new-pill">New!</span>Now 100% cloud based!</div>
                <h1>Your official, 100% cloud-based speed trading assistant</h1>
                <h2>The fastest, simplest and most safe interface for short-term trading on <strong>Bittrex, Binance</strong> and <strong>Cryptopia</strong> - from manual trades to pump and dumps.</h2>
            </div>
            <div class="col-md-6">
                <div class="screenshot"></div>
            </div>
        </div>
    </section>
<section id="Exchanges" class="alt-background">
    <div class="container">
        <h3>Supported exchanges</h3>
        <span class="exchange bittrex"></span>
        <span class="exchange binance"></span>
        <span class="exchange cryptopia"></span>
    </div>
</section>
<section class="alt-background-dark banner">
    <div class="container">
        <div class="col-md-8">
            <h3>Ready to get started?</h3>
            <span>Buy your copy of BitcoinThief Bot today or click on login to access dashboard.</span>
        </div>
        <div class="col-md-4">
            <a class="button" id="buyBanner" href="<?= SITEPATH.'register';?>">Register</a>
            <a class="button light" id="demoBanner" href="<?= SITEPATH.'login';?>">Login</a>
        </div>
    </div>
</section><!-- End page content -->
<!-- Footer -->
<div class="footer-wrapper">
    <div id="Contact">
        <div class="container">
            <p>Questions or comments? send us an Email at <a href="" target="_blank">Johnmccollins.ru@gmail.com</a></p>
        </div>
    </div>
    <footer>
        <div class="container">
            <p>© 2018 BitcoinThief Bot. All Rights Reserved.</p>
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