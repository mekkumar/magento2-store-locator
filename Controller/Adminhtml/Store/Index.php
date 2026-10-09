<?php
namespace Kumar\StoreLocator\Controller\Adminhtml\Store;
class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = "Kumar_StoreLocator::storelocator";
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view
            ->getPage()
            ->getConfig()
            ->getTitle()
            ->prepend(__("Store Locator Stores"));
        $this->_view->renderLayout();
    }
}
