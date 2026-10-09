<?php
namespace Kumar\StoreLocator\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        return $this->resultFactory->create(
            \Magento\Framework\Controller\ResultFactory::TYPE_PAGE
        );
    }
}
