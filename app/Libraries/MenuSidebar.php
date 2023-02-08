<?php
namespace App\Libraries;

use App\Models\SysSidebarModel;

class MenuSidebar 
{
    static $htmlSidebarMenu ='';

    function _drop_simple_menu($data)
    {
        $url =  site_url($data['resource_router']);
        return "<li><a class='dropdown-item' href='{$url}'>{$data['label']}</a></li>";
    }

    function _drop_compuesto_menu($data, $item='')
    {
        return "<li class='nav-item dropdown drop-down02'>
                    <a class='nav-link dropdown-toggle nx' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        {$data['label']}
                    </a>
                    <ul class='dropdown-menu sub-drop-submenu' aria-labelledby='navbarDropdown'>
                        {$item}
                    </ul>
                </li>";
    }

    function _drop_sidebar($data)
    {
        $code="";
        if($data['submenu'] == false){
            $code.= $this->_drop_simple_menu($data);
        }else{
            $item="";
            foreach ($data['submenu'] as $ai => $row) {
                $item.= $this->_drop_sidebar($row);    
            }
            $code.= $this->_drop_compuesto_menu($data, $item);                
        }      
        return $code;
    }

    public function prepareTreeData(array $sysSidebars, int $id)
    {
        $datos = array();
        foreach ($sysSidebars as $row)
        {
            if($row['estado'] == '0' || $row['estado'] == 'I') continue;
            if($id == $row['sys_sidebar_id'])
            {
                $datos[] = array(
                    "id"=> $row['id'],
                    "label"=> $row['label'],
                    "resource_router"=> $row['resource_router'],
                    'submenu' => $this->prepareTreeData($sysSidebars, $row['id'])
                );
            }
        }
        return (count($datos) == 0)? false : $datos;
    }
    
    public function main(array $sysSidebars): string
    {  
        $treeMenuSidebar = array();
        foreach ($sysSidebars as $row)
        {
            if($row['estado'] == '0' || $row['estado'] == 'I') continue;
            if(!$row['sys_sidebar_id'])
            {
                $datos[] = array(
                    "id"=> $row['id'],
                    "label"=> $row['label'],
                    "resource_router"=> $row['resource_router'],
                    'submenu' => $this->prepareTreeData($sysSidebars, $row['id'])
                );
            }
        }
        $htmlSidebarMenu ='';
        foreach ($treeMenuSidebar as $ai => $row) {
            $htmlSidebarMenu.= $this->_drop_sidebar($row, "");
        }
        return $htmlSidebarMenu;
    }
}