<?php
namespace Sdk\Application\Commitment\Model;

use Marmot\Core;
use Marmot\Interfaces\INull;

use Sdk\Common\Model\Traits\NullExamineAbleTrait;
use Sdk\Common\Model\Traits\NullOperateAbleTrait;

class NullPromise extends Promise implements INull
{
    use NullOperateAbleTrait, NullExamineAbleTrait;

    private static $instance;

    public static function &getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function resourceNotExist() : bool
    {
        Core::setLastError(RESOURCE_NOT_EXIST);
        return false;
    }
}
