<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Masaze</title>
        <link href="<?php echo URL ;?>public/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo URL ;?>public/css/my-style.css" rel="stylesheet" type="text/css">
        
        <?php if(isset($this->css)){ foreach ($this->css as $css){ ?>
            <link href="<?php echo URL ;?>views/<?php echo $css; ?>" rel="stylesheet" type="text/css">
        <?php }} ?>
        <script src="<?php echo URL ;?>public/js/jQuery.js" type="text/javascript"></script>
        <script src="<?php echo URL ;?>public/js/default.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <div id="header-top">
                <div class="wrapper">
                    <div id="contanct">
                        <p><i class="fas fa-phone-square"></i> 064/333-33-33</p>
                        <p><i class="far fa-envelope"></i> lotos@gmail.com</p>
                    </div><!-- end #contact -->
                    <div id="media">
                        <p id="icons">
                            <a href="https://www.facebook.com/" target="_blank" title="facebook"><i class="fab fa-facebook-square"></i></a>
                            <a href="https://twitter.com/" target="_blank" title="twitter"><i class="fab fa-twitter-square"></i></a>
                            <a href="https://www.instagram.com/" target="_blank" title="instagram"><i class="fab fa-instagram"></i></a>
                        </p>
                    </div><!-- end #media -->
                </div><!-- end .wrapper -->
            </div><!-- end #header-top -->
            <div id="header-bottom">
                <div class="wrapper">
                    <div id="logo">
                        <a href="<?php echo URL; ?>"><img src="<?php echo URL; ?>public/images/logo.png" width="100" height="80"/></a>
                    </div><!-- end #logp -->
                    <div id="nav">
                        <ul>
                            <li><a class="nav" href="<?php echo URL ?>service">tretmani</a></li>
                            <li><a class="nav" href="<?php echo URL ?>blog">blog</a></li>
                            <li><a class="nav" href="<?php echo URL ?>/contact">kontakt</a></li>
                            <?php if(!Session::get("loggedin")){ ?>
                                <li><a class="nav" href="<?php echo URL ?>login">login</a></li>
                            <?php }else{ ?>
                                <?php if(Session::get("role") == "admin"){ ?>
                                    <li><a class="nav" href="<?php echo URL ?>admin">admin</a></li>
                                <?php }else{ ?>
                                    <li><a class="nav" href="<?php echo URL ?>profil">profil</a></li>
                                <?php } ?>
                                <li><a href="<?php echo URL ?>index/logout">logout</a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- end #nav -->
                </div><!-- end .wrapper -->
            </div><!-- end #header-bottom -->
        </header>
