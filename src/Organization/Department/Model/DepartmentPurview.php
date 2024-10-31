<?php
namespace Sdk\Organization\Department\Model;

use Sdk\Role\Purview\Model\Purview;
use Sdk\Role\Purview\Model\IPurviewAble;

class DepartmentPurview extends Purview
{

    public function __construct()
    {
        parent::__construct(IPurviewAble::COLUMN['DEPARTMENT']);
    }

    public function add() : bool
    {
        return $this->operation('add');
    }

    public function edit() : bool
    {
        return $this->operation('edit');
    }
}
