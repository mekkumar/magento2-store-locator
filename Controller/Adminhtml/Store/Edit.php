<?php
namespace Kumar\StoreLocator\Controller\Adminhtml\Store;
use Magento\Framework\Registry;
use Kumar\StoreLocator\Model\StoreFactory;
class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = "Kumar_StoreLocator::storelocator";
    private $registry;
    private $storeFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Registry $registry,
        StoreFactory $storeFactory
    ) {
        parent::__construct($context);
        $this->registry = $registry;
        $this->storeFactory = $storeFactory;
    }
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam("id");
        $store = $this->storeFactory->create();
        if ($id) {
            $store->load($id);
            if (!$store->getId()) {
                $this->messageManager->addErrorMessage(__("Store not found."));
                return $this->_redirect("*/*/index");
            }
        }
        $this->registry->register("kumar_storelocator_store", $store);
        $this->_view->loadLayout();
        $this->_view
            ->getPage()
            ->getConfig()
            ->getTitle()
            ->prepend($id ? __("Edit Store") : __("New Store"));
        $this->_view->renderLayout();
    }
}
