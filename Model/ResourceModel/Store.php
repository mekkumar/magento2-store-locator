<?php
namespace Kumar\StoreLocator\Model\ResourceModel;
class Store extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('kumar_storelocator_store', 'entity_id');
    }
}
