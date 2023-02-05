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

        if(isset($params['value'])){
            $value = $params['value'];
            unset($params['value']);
        }

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