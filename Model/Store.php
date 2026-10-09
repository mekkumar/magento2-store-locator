<?php
namespace Kumar\StoreLocator\Model;
class Store extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Kumar\StoreLocator\Model\ResourceModel\Store::class);
    }
}
