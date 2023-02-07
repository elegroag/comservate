<?php
namespace App\Services;

use App\Libraries\MenuSidebar;
use App\Models\SysSidebarModel;

class SysSidebarService
{
    private $sysSidebarModel;

    public function __construct()
    {
        $this->sysSidebarModel = new SysSidebarModel;
    }

    public function getSysSidebars()
    {
        return $this->sysSidebarModel->findAll();
    }

    public function getSysSidebarById($id)
    {
        return $this->sysSidebarModel->find($id);
    }

    public function createSysSidebar($data)
    {
        return $this->sysSidebarModel->insert($data);
    }

    public function updateSysSidebar($id, $data)
    {
        return $this->sysSidebarModel->update($id, $data);
    }

    public function deleteSysSidebar($id)
    {
        return $this->sysSidebarModel->delete($id);
    }

    public function createMenuEscritorio()
    {
        $sysSidebars = $this->getSysSidebars();      
        $menuSidebar = new MenuSidebar();
        return $menuSidebar->main($sysSidebars);
    }

    public function createMenuMobile()
    {
        $sysSidebars = $this->getSysSidebars();      
        $menuSidebar = new MenuSidebar();
        return $menuSidebar->main($sysSidebars);
    }
    
}

