<?php

if (! function_exists('utils_params')) {

    function utils_params($params, $num)
    {
        if(isset($params[0]) && is_array($params[0]) && $num==1){
			return $params[0];
		} else {
			$data = array();
			$i = 0;
			foreach($params as $p) 
            {
				if(is_string($p) && preg_match('/([a-zA-Z_0-9]+): (.*)/', $p, $regs)){
					$data[$regs[1]] = $regs[2];
				} else {
					$data[$i] = $p;
				}
				++$i;
			}
			return $data;
		}
    }
}

if (! function_exists('text_upper_field')) {
    
    function text_upper_field($params)
    {
        $numberArguments = func_num_args();
        $params = utils_params(func_get_args(), $numberArguments);
        
        if(!isset($params[0])){
            $params[0] = $params['id'];
        }
        
        if(!isset($params['name'])||$params['name']==""){
            $params['name'] = $params[0];
        }

        $value ='';
        if(isset($params['value'])) $value = $params['value']; unset($params['value']);

        $params['class'] = (!isset($params['class']))? "text-uppercase form-control" : "text-uppercase form-control ".$params['class'];

        $params['onblur']= (isset($params['onblur']))? $params['onblur'].",$(this).val().toUpperCase()": "$(this).val().toUpperCase()";

        $value = str_replace("'","",$value);
        $code = "<input type='text' id='{$params[0]}' value='{$value}' ";
        
        foreach($params as $_key => $_value)
        {
            if(!is_integer($_key))
            {
                $code.=" {$_key}='{$_value}' ";
            }
        }
        $code.=" />\r\n";
        return $code;
    }
}

if (! function_exists('numeric_field')) {
    
    function numeric_field($params)
    {
        $numberArguments = func_num_args();
        $params = utils_params(func_get_args(), $numberArguments);
        
        if(!isset($params[0])){
            $params[0] = $params['id'];
        }

        if(!isset($params['name'])||!$params['name']){
            $params['name'] = $params[0];
        }

        if(isset($params['value'])) {
            $value = $params['value'];
            unset($params['value']);
        }

        $params['class'] = (!isset($params['class']))? "form-control" : "form-control ".$params['class'];

        $params['onkeydown']= (isset($params['onkeydown']))? $params['onkeydown'].",valNumeric(this)": "valNumeric(this)";
        
        $code = "<input type='text' id='{$params[0]}' value='{$value}' ";
        
        foreach($params as $key => $value)
        {
            if(!is_integer($key))
            {
                $code.=" {$key}='{$value}' ";
            }
        }
        $code.=" />\r\n";
        return $code;
    }
}

if (! function_exists('money_field')) {
    
    function money_field($params)
    {
        $numberArguments = func_num_args();
        $params = utils_params(func_get_args(), $numberArguments);
        if(!isset($params[0])){
            $params[0] = $params['id'];
        }

        if(!isset($params['name'])||!$params['name']){
            $params['name'] = $params[0];
        }

        if(isset($params['value']))
        {
            $value = $params['value'];
            unset($params['value']);
        }
        $params['class'] = (!isset($params['class']))? "form-control" : "form-control ".$params['class'];

        $params['onkeydown'] = (isset($params['onkeydown']))? $params['onkeydown'].",valNumeric(this),formatMoney(this)": "valNumeric(this), formatMoney(this)";

        $code = "<input type='text' id='{$params[0]}' value='{$value}' ";
        foreach($params as $key => $value)
        {
            if(!is_integer($key))
            {
                $code.=" {$key}='{$value}' ";
            }
        }
        $code.=" />\r\n";
        return $code;
    }
}

if (! function_exists('select_statico')) {
    
    function select_statico( $params='', $data='')
    {
        $numberArguments = func_num_args();
        $arguments = func_get_args();
        $params = utils_params($arguments, $numberArguments);
        $value = "";

        if(is_array($params))
        {    
            if(isset($params['value'])){
                $value = $params['value'];
            }

            $code ="<select id='{$params[0]}' name='{$params[0]}' ";

            if(!isset($params['dummyValue'])){
                $dummyValue = '@';
            } else {
                $dummyValue = $params['dummyValue'];
                unset($params['dummyValue']);
            }

            if(!isset($params['dummyText'])){
                $dummyText = 'Seleccione...';
            } else {
                $dummyText = $params['dummyText'];
                unset($params['dummyText']);
            }
            $params['class'] = (!isset($params['class']))? "text-uppercase form-control" : "text-uppercase form-control ".$params['class'];

            if(is_array($params)){
                foreach($params as $at => $val)
                {
                    if(!is_integer($at))
                    {
                        if(!is_array($val))
                        {
                            $code.= " {$at}='{$val}' ";
                        }
                    }
                }
            }

            $code.=">\r\n";

            if(isset($params['use_dummy']) && $params['use_dummy']){
                $code.="\t<option value='$dummyValue'>$dummyText</option>\r\n";
                unset($params['use_dummy']);
            } else {
                if(isset($params['useDummy'])&&$params['useDummy']){
                    $code.="\t<option value='$dummyValue'>$dummyText</option>\r\n";
                    unset($params['useDummy']);
                }
            }

            if(is_array($params[1]))
            {
                foreach($params[1] as $k => $d)
                {
                    if($k == $value && $value !== ''){
                        $code.=" \t<option value='$k' selected='selected'>$d</option>\r\n";
                    } else {
                        $code.=" \t<option value='$k'>$d</option>\r\n";
                    }
                }
            }

            $code.= "</select>\r\n";
        }
        return $code;
    }
}

if (! function_exists('password_field')) {
    
    function password_field($params)
    {
        $numberArguments = func_num_args();
        $params = utils_params(func_get_args(), $numberArguments);
        
        if(!is_array($params)){
            return "<input type='password' id='$params' name='$params'/>\r\n";
        } else {
            if(!isset($params[0])) {
                $params[0] = $params['id'];
            }

            if(!isset($params['name'])||!$params['name']) {
                $params['name'] = $params[0];
            }

            if(!isset($params['value'])){
                $params['value'] = $params[0];
            }

            $code = "<input type='password' id='{$params[0]}' ";

            $params['class'] = (!isset($params['class']))? "text-uppercase form-control" : "text-uppercase form-control ".$params['class'];
            
            foreach($params as $key => $value){
                if(!is_integer($key)){
                    $code.=" {$key}='{$value}' ";
                }
            }
            $code.=" />\r\n";
            return $code;
        }
    }
}

if (! function_exists('linkTo')) {
    
    function linkTo($action, string $text='')
    {
        $numberArguments = func_num_args();
        $params = utils_params(func_get_args(), $numberArguments);
        $params['action'] = (isset($params[0]))? $params[0] : '#';
        $params['text'] = (isset($params[1]))? $params[1] : '';
        $params['class'] = (isset($params['class']))? $params['class']: '';

        if(isset($params['confirm']) && $params['confirm'])
        {
            if(!isset($params['onclick'])) $params['onclick'] = "";
            $params['onclick'] = 'Swal.fire({'."title: \"¿Puedes comfirmar la acción? Por favor.\", ".
            "text: \"¡No podrás revertir esto!\",icon: \"warning\",showCancelButton: true, ".
            "confirmButtonColor: \"#3085d6\",".
            "cancelButtonColor: \"#d33\",confirmButtonText:\"SI, está de acuerdo!\"".'}).then('.
            'function(result){ if (result.isConfirmed){'." Swal.fire(\"Comfirmado!\",\"Se procede a ejecutar el proceso.\",\"success\"); ".$params['onclick'].' }else{ return false; });';
            unset($params['confirm']);
        }

        $code = "<a href='".site_url($params['action'])."' ";
        foreach($params as $key => $value)
        {
            if(!is_integer($key) && $key!='text'){
                $code.=" $key='$value' ";
            }
        }
        $code.='>'.$params['text'].'</a>';
        return $code;
    }
}

if (! function_exists('formBoostrap')) 
{
    function formBoostrap(string $content, string $label)
    {
        $numberArguments = func_num_args();
        $params = utils_params(func_get_args(), $numberArguments);

        $params['action'] = (isset($params['action']))? $params['action'] : '#';
        $params['class'] = (isset($params['class']))? $params['class']: '';
        $params['label'] = (isset($params['label']))? $params['label'] : '';
        $params['id'] = (isset($params['id']))? $params['id'] : '';

        $out = "".
        "<div class=\"row {$params['class']}\">".
            "<label class=\"col-md-3 col-form-label\">{$params['label']}:</label>".
            "<div class=\"col-md-9\">".
                "<div class=\"form-group\" data-toggle=\"help-{$params['id']}\">".$content."</div>".
                "<label id=\"has_error_{$params['id']}\" class=\"error txt-primary\" for=\"required\">El valor {$params['label']} ingresado no es válido.</label>".
                "<div class=\"category form-category\">* Campo requerido</div>".
            "</div>".
        "</div>";
        return $out;
    }
}

if ( ! function_exists('sanetizar'))
{
    function sanetizar($string)
	{
		$string = trim($string);
		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
		);
	
		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
		);
	
		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
		);
	
		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
		);
	
		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
		);
	
		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
		);
	
		$string = str_replace(
			array("¨", "º", "-", "~","·", "$", "%", "&", "/","°","*",
				"(", ")", "?", "'", "¡",
				"¿", "[", "^", "<code>", "]",
				"+", "}", "{", "¨", "´",
				">", "< ", ";", ",", ":"),'',$string);
	
		return $string;
  	}
}

if ( ! function_exists('js_notify')){
    function js_notify(){
        return script_tag('assets/bootstrap/bootstrap-notify.min.js');
    }
}

if ( ! function_exists('js_datetimepicker')){
    function jsdatetimepicker(){
        return script_tag('assets/bootstrap/bootstrap-datetimepicker.js');
    }
}

if ( ! function_exists('js_bootstrap_select')){
    function js_bootstrap_select(){
        return script_tag('assets/bootstrap/bootstrap-select.min.js');
    }
}

if ( ! function_exists('js_moment')){
    function js_moment(){
        return script_tag('assets/moment/moment.js');
    }
}

if ( ! function_exists('js_sweetalert2')){
    function js_sweetalert2(){
        return script_tag('assets/sweetalert2/sweetalert2.min.js');
    }
}