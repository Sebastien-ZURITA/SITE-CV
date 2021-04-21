<?php
class form{
    public $action;
    
    function __construct($action){

        $this->action = $action;
    }

    /**
     * IMPUT
     */
    function imput($name,$label,$value='',$placeholder=false){
        If($placeholder==false){$placeholder = $label;}
        $html ='<label for="'.$name.'">'.$label.'</label>';
        $html .='<input type="text" class="form-control" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'"';
        if($this->action !='insert'){$html .= 'value="'.$value.'"';}        
        $html .='>';

        return $html;
    }

    function hidden($name,$value=''){
        $html ='<input type="hidden" class="form-control" name="'.$name.'" id="'.$name.'"';
        $html .= 'value='.$value;        
        $html .='>';

        return $html;
    }
    function textarea($name,$label,$value=''){
        
        $html ='<label for="'.$name.'">'.$label.'</label>';
        $html .='<textarea class="form-control" name="'.$name.'" id="'.$name.'" rows="7" >';
        if($this->action !='insert'){$html .= $value;}
        $html .='</textarea>';

        return $html;
    }
    function checkbox($name,$label,$value=''){
        $html = '<input class="form-check-input" type="hidden" name="'.$name.'" value ="0">';
        $html .= '<input class="form-check-input" type="checkbox" name="'.$name.'" value ="1" ';
        if($value==1 and $this->action !='insert'){$html .='checked';}
        $html .='>';
        $html .='<label class="form-check-label" for="gridCheck">';
        $html .= $label;
        $html .= '</label>';

        return $html;
    }

}