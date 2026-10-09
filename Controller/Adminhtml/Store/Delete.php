<?php
namespace Kumar\StoreLocator\Controller\Adminhtml\Store;
class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = "Kumar_StoreLocator::storelocator";
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam("id");
        try {
            $model = $this->_objectManager
                ->create(\Kumar\StoreLocator\Model\Store::class)
                ->load($id);
            if ($model->getId()) {
                $model->delete();
            }
            $this->messageManager->addSuccessMessage(__("Store deleted."));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __("Could not delete store.")
            );
        }
        return $this->_redirect("*/*/index");
    }
}
