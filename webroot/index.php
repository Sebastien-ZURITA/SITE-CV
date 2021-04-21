<?php

$debut = microtime(true);
/** DOSSIER RACINE DU SITE **/
define ('WEBROOT',dirname(__FILE__));

/** DOSSIER RACINE DE L'APPLICATION **/
define ('ROOT',dirname(WEBROOT));
/** SAPERATEUR DOSSIER **/
define ('DS', DIRECTORY_SEPARATOR);
/** DOSSIER CONTENANT LE FRAMEWORK (CORE) **/
define ('CORE', ROOT.DS.'core');
/** BASE URL **/
//if(dirname(dirname($_SERVER['SCRIPT_NAME']))!=='\\' and 
if($_SERVER['SERVER_ADDR']!='127.0.0.1') {
    $baseUrl = 'https://'.$_SERVER['SERVER_NAME'];
}else{
    $baseUrl = 'http://'.$_SERVER['SERVER_NAME'];
}

define ('BASE_URL', $baseUrl);
/** FICHIER DE PARAMETRAGE DU CORE **/
require CORE.DS.'config.php';
?>
<div style="postion:fixed; bottom:0; background-color:#FA6755; color :#FFF;
line-height:30px; height:30px; left:0; right:0; padding-left:10px;">
<?php
echo 'Page générée en '.round(microtime(true)-$debut,5).' secondes';
?>