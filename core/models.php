<?php
class Models{
    static $connections =array();
    public $type ='default';
    public $table = false;
    public $db;
    public $primaryKey = false;


    function __construct(){
        $conf=Conf::$databases[$this->type];
        if($this->table===false){
            $this->table = strtolower (get_class($this));
            if($this->primaryKey===false){
                $this->primaryKey = $this->table.'Id';
            }
        }

        if (isset(Models::$connections[$this->type])){
            $this->db =Models::$connections[$this->type];
            return true;
        }
        try {
            $pdo = new PDO('mysql:dbname='.$conf['database'].';host='.$conf['host'], $conf['login'], $conf['pw'],array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            Models::$connections[$this->type]=$pdo;
            $this->db =Models::$connections[$this->type];
        
        } catch (PDOException $e) {
            if(Conf::debug >=1){
                die ('Connexion échouée : ' . $e->getMessage());
            }else{
                die ('Impossible de se connecter à la base de données');
            }
        }

    }

    /**
     * PERMET DE FAIRE UNE SELECT D'ELEMENT DANS LES TABLES
     */
    function get($req=null){

        $sql ='Select ';

        if(isset($req['list']) ){
            if(is_array($req['list'])){
                $sql .=implode(',',$req['list']);
            }else{
                $sql .=$req['list'];
            }
        }else{
            $sql .=' * ';
        }

        $sql .= ' from '.$this->table.' ';
        
        if(isset($req['conditions'])and count($req['conditions'])>0){
            $sql .= $this->cond($req['conditions']);
        }

        if(isset($req['limit']) and $req['limit']!= null){
            $sql .= ' LIMIT '. $req['limit'];
        }
        
//***** TEST SZA

//debug($sql);

//***** END TEST SZAs

        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * PERMET DE PARSER LE TABLEAU DE CONDITION
     */
    function cond($condArray){
        $r = 'where ';
        $r .= implode(' AND ',$condArray);

        return $r;
    }

    /**
     * RENVOIS QU'UN ENREGISTREMENT SELECTIONNE
     */
    function find($req){

        return current($this->get($req));
    }
    
    /**
     * PERMET DE RECUPERE LES NOMBRE D'ENREGISTREMENT
     */
    function findCount($conditions){
        $result = $this->find(
                array(
                    'list' => 'COUNT('.$this->primaryKey.') as count',
                    'conditions' =>$conditions
                )
            );
        if(isset($result['count'])){
            return $result['count'];
        }else{
            return false;
        }
    }

    /**
     * REQUETE DE SUPPRESSION
     */
    function delete($id){
        $sql ='Delete from '.$this->table.' where '.$this->primaryKey.' = '.$id;
        $this->db->query($sql);
    }

    /**
     * INFORMATION STRUCTURE DE LA TABLE
     */
    function infoStruct(){

        $sql = 'SELECT TABLE_NAME,COLUMN_NAME,DATA_TYPE,COLUMN_KEY,COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = \''.$this->table.'\'order by ORDINAL_POSITION';
        //debug($sql);
        $pre = $this->db->prepare($sql);
        $pre->execute();
        $data = $pre->fetchAll(PDO::FETCH_CLASS);
        foreach($data as $k=>$v){

            if(!empty($v->COLUMN_COMMENT) and strpos($v->COLUMN_COMMENT,'{')===0){
                $r = json_decode($v->COLUMN_COMMENT);
                $label = $r->label;
            }else{
                $label = str_replace($this->table,'',$v->COLUMN_NAME);
            }
 
            //debug($v->COLUMN_COMMENT.'-'.strpos($v->COLUMN_COMMENT,'{').'-'.$label);
            $d[$v->COLUMN_NAME] = array(
                'TYPE'      => $v->DATA_TYPE,
                'KEY'       => $v->COLUMN_KEY,
                'LABEL'     => $label
            );
        }
        return $d;
    }

    /**
     * INSERTION DE DONNEES
     */
    function insert($data){
        $sql = 'Insert into '.$this->table;
        $values = array();
        $list = array();
        unset($data->{$this->primaryKey});
        foreach($data as $k=>$v){
            if (is_numeric($v)){
                $v =  $v;
            }else{
                $v = '"'.$v.'"';
            }
            $list[]=$k;
            $values[]=$v;
        }
        $sql .= ' ('.implode(",",$list).') values ('.implode(",",$values).');';
        $this->db->query($sql);
        return true;

    }

    /**
     * UPDATE DES DONNEES
     */
    function update($data){
        $sql = 'update '.$this->table.' set ';
        $values = '';
        if(isset($data->{$this->primaryKey})){

            foreach($data as $k=>$v){
                if($k != $this->primaryKey){
                    if (is_numeric($v) or is_bool($v)){
                        $values .=  $k.'='.$v.',';
                    }else{
                        $values .=  $k.'="'.$v.'",';
                    }
                }else{
                    $where = ' where '.$this->primaryKey.' = '.$v;
                }
            }
            $values = trim($values,',');
            $sql .= $values.$where.';';
        }
        $this->db->query($sql);
        return true;
    }


}
