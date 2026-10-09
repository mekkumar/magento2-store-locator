<?php
namespace Kumar\StoreLocator\Block\Adminhtml\Store;
class Grid extends \Magento\Backend\Block\Template
{
    private $collectionFactory;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Kumar\StoreLocator\Model\ResourceModel\Store\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }
    public function getStores()
    {
        return $this->collectionFactory
            ->create()
            ->setOrder("sort_order", "ASC");
    }
    public function getEditUrl($id = null)
    {
        return $this->getUrl(
            "storelocator/store/edit",
            $id ? ["id" => $id] : []
        );
    }
    public function getDeleteUrl($id)
    {
        return $this->getUrl("storelocator/store/delete", [
            "id" => $id,
            "form_key" => $this->getFormKey(),
        ]);
    }
}
