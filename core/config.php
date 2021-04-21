<?php
/**
 * DEFINITION DES CONSTANTES DU FRAMEWORK MVC
 **/

/** DOSSIER CONTENANT LES MODELS **/
define ('MODELS', ROOT.DS.'models');
/** DOSSIER CONTENANT LES VIEWS **/
define ('VIEWS', ROOT.DS.'views');
/** DOSSIER CONTENANT LES CONTROLLERS **/
define ('CTLS', ROOT.DS.'controllers');
/** DOSSIER CONTENANT LES CONTROLLERS **/
define ('CONF', ROOT.DS.'config');

/**
 * INTEGRATION DES FICHIERS DONT LE MOTEUR BESOIN
 **/
require 'session.php';
require 'fonction.php';
require 'router.php';
require CONF.DS.'conf.php';
require 'form.php';
require 'request.php';
require 'controllers.php';
require 'models.php';
require 'dispatcher.php';


/**
 * INITIALISATION CLASS DISPATCHER
 **/
new Dispatcher;


?>
