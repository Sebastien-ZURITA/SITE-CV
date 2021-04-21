<?php
class Conf{
    static $debug =1;
    static $databases=array(
        'default' => array(
            'host'          =>  'localhost',
            'database'      =>  'dbs1827683',
            'login'         =>  'root',
            'pw'            =>  ''
        ),
		'prod' => array(
            'host'          =>  'db5002268685.hosting-data.io',
            'database'      =>  'dbs1827683',
            'login'         =>  'dbu410385',
            'pw'            =>  'Ddb-ssd_SEBASTIEN-21'
        )
        );
    
}

/**
 * LISTING DES PREFIX
 */
Router::prefix('cokpite','admin');
Router::prefix('gestion','erp');

/**
 * REGLES DE ROUTAGE
 */
Router::connect('post/:Slug-:Id','posts/view/postsId:([0-9]+)/postsSlug:([a-z0-9\-]+)');
