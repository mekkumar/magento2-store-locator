<?php
namespace Kumar\StoreLocator\Block\Adminhtml\Store;
class Edit extends \Magento\Backend\Block\Template
{
    private $registry;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
    }
    public function getStore()
    {
        return $this->registry->registry("kumar_storelocator_store");
    }
    public function getSaveUrl()
    {
        return $this->getUrl("storelocator/store/save");
    }
    public function getBackUrl()
    {
        return $this->getUrl("storelocator/store/index");
    }
}
