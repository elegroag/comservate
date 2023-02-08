<?php
namespace App\Libraries;

class MenuSidebar 
{

    public static $treeMenuSidebar = array();
    public static $itemsDrop = array();

    static function dropSimpleItem($data)
    {
        return "".
        "<li>".linkTo($data['resource_router'], 
            '<span class="sidebar-mini-icon">'.$data['icon'].'</span><span class="sidebar-normal"> '.$data['label'].'</span>', 
            'class: link-warning ps-2 pb-0 fs-6')."
        </li>";
    }

    static function dropMultipleItems($data, $item='')
    {
        $name = str_replace(" ","_", trim(strtolower($data['label'])));
        self::$itemsDrop[] = $name; 
        return ""."
        <li class=\"mb-1\" data-collapse-item=\"{$name}\">
            <a type='button' data-toggle=\"collapse\" class=\"btn-toggle align-items-center collapsed fs-7\" data-bs-toggle=\"collapse\" data-bs-target=\"#{$name}-collapse\" aria-expanded=\"false\">
                <i class=\"{$data['icon']}\"></i>
                <p>{$data['label']} <b class=\"caret\"></b></p>
            </a>
            <div class=\"collapse\" id=\"{$name}-collapse\">
                <ul class=\"btn-toggle-nav list-unstyled pb-0\">
                    {$item}
                </ul>
            </div>
        </li>";
    }

    static function dropSidebar($data)
    {
        $code="";
        if($data['submenu'] == false){
            $code.= self::dropSimpleItem($data);
        } else {
            $item="";
            foreach ($data['submenu'] as $ai => $row) {
                $item.= self::dropSidebar($row);    
            }
            $code.= self::dropMultipleItems($data, $item);                
        }
        return $code;
    }

    public static function prepareTreeData(array $sysSidebars, int $id)
    {
        $datos = array();
        foreach ($sysSidebars as $row)
        {
            if($row['estado'] == 'O' || $row['estado'] == 'I') continue;
            if($id != $row['sys_sidebar_id']) continue;
           
            $datos[] = [
                "id"=> $row['id'],
                "label"=> $row['label'],
                "resource_router"=> $row['resource_router'],
                "icon"=> $row['icon'],
                "estado"=> $row['estado'],
                'submenu' => self::prepareTreeData($sysSidebars, $row['id'])
            ];
        }
        return (count($datos) == 0)? false : $datos;
    }
    
    public static function mainGenerate(array $sysSidebars): string
    {  
        self::$treeMenuSidebar = array();
        self::$itemsDrop = array();

        foreach ($sysSidebars as $row)
        {
            if($row['estado'] == 'O' || $row['estado'] == 'I') continue;
            if(!$row['sys_sidebar_id'])
            {
                self::$treeMenuSidebar[] = [
                    "id"=> $row['id'],
                    "label"=> $row['label'],
                    "resource_router"=> $row['resource_router'],
                    "icon"=> $row['icon'],
                    "estado"=> $row['estado'],
                    'submenu' => self::prepareTreeData($sysSidebars, $row['id'])
                ];
            }
        }

        $htmlSidebarMenu ='';
        foreach (self::$treeMenuSidebar as $row) 
        {
            $htmlSidebarMenu.= self::dropSidebar($row, "");
        }
        return $htmlSidebarMenu;
    }
}