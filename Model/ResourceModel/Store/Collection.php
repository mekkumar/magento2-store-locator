<?php
namespace Kumar\StoreLocator\Model\ResourceModel\Store;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Kumar\StoreLocator\Model\Store::class,
            \Kumar\StoreLocator\Model\ResourceModel\Store::class
        );
    }
}
