<!DOCTYPE html>
<html lang="fr">
    <!-- ref entete-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mon atelier en ligne</title>
        <!-- Icone Onglet -->
        <link rel="icon" type="image/ico" href="<?php echo BASE_URL?>/img/favicon.ico" />
        <!--CSS-->
        <link rel="stylesheet" href="<?php echo BASE_URL?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASE_URL?>/css/style.css">
        <link rel="stylesheet" media="screen and (max-width: 1024px)" href="<?php echo BASE_URL?>/css/style_small.css">
        <!-- JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="<?php echo BASE_URL?>/js/bootstrap.bundle.min.js"></script>


    </head>
    <!-- End ref entete -->
    <!-- contenu du site -->
    <body>
        <?php 
        /*
            echo '<pre>';
            print_r($_SERVER);
            echo '</pre>';
        */
        ?>
        <header class="container-fluid header">
            <div class="container">            
                <div class="logo">
                    <a href="<?php echo BASE_URL?>" >Sébastien ZURITA</a>
                </div>
                <?php echo $navbar; ?>
            </div> 
        </header>
        <?php echo $content_for_layout; ?>
        <!-- Footer -->
        <footer class="container-fluid footer">
            <div class="container">
                <h2 id="contact">Contactez-moi</h2>
                <hr class="separator_2">
                <div class="row">
                   <!-- <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 item-folio">-->
                   <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 item-folio">
                       <!-- <h3>Réseau Social</h3>
                        <hr class="separator_3">-->
                        <div class="row">
                            <div class="icon"><a href="https://www.linkedin.com/in/sebastien-zurita" target="_blank"><img src="<?php echo BASE_URL?>/img/linkedin.png" alt="Linkedin"/></a></div>
                            <div class="icon"><a href="https://www.facebook.com/sebastien.zurita" target="_blank"><img src="<?php echo BASE_URL?>/img/facebook.png" alt="Facebook"/></a></div>
                            <div class="icon"><a href="mailto:sebastien@zurita.fr?subject=Premier contact" target="_blank"><img src="<?php echo BASE_URL?>/img/mail.png" alt="mail"/></a></div>
                            <div class="icon"><a href="https://www.spotify.com/fr" target="_blank"><img src="<?php echo BASE_URL?>/img/spotify.png" alt="Spotify"/></a></div>
                        </div>
                        <!--<div class="row img-footer">
                            <img src="https://blog.integral-system.fr/wp-content/uploads/2017/12/industry-4-0-dm4674.jpg" />
                        </div> -->
                    </div>
                    <!--
                    <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 item-folio">
                        <div class="form-area">  
                            <form role="form" method="post">
                                <br style="clear:both">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete = "nickname" required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required/>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" type="textarea" id="message" placeholder="Message" maxlength="140" rows="7"></textarea>                 
                                </div>
                                <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Envoyer</button>
                            </form>
                        </div>
                    </div>-->
                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 item-folio">
                        <div class="licence">
                            <p>Image made by <a href="https://fr.freepik.com/photos-vecteurs-libre/affaires">Affaires photo créé par rawpixel.com - fr.freepik.com</a>
                            - Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a>
                            </br> Copyright (c) 2020 Copyright Holder Sébastien ZURITA All Right Reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </body>
    <!-- End contenu du site-->


</html>