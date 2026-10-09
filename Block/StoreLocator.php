<?php
namespace Kumar\StoreLocator\Block;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Kumar\StoreLocator\Model\ResourceModel\Store\CollectionFactory;
class StoreLocator extends Template
{
    private $collectionFactory;
    private $storeManager;
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->storeManager = $storeManager;
    }
    public function isEnabled(): bool
    {
        return (bool) $this->_scopeConfig->getValue(
            "kumar_storelocator/general/enabled",
            ScopeInterface::SCOPE_STORE
        );
    }
    public function getStores(): array
    {
        $collection = $this->collectionFactory->create();
        $collection
            ->addFieldToFilter("status", 1)
            ->setOrder("sort_order", "ASC");
        return $collection->getData();
    }
    public function getJsonStores(): string
    {
        $stores = $this->getStores();
        foreach ($stores as &$store) {
            foreach (["logo", "marker_icon", "active_marker_icon"] as $field) {
                if (
                    !empty($store[$field]) &&
                    strpos($store[$field], "http") !== 0
                ) {
                    $store[$field] = $this->getMediaUrl(
                        ltrim($store[$field], "/")
                    );
                }
            }
        }
        return (string) json_encode(
            $stores,
            JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT
        );
    }
    public function getGoogleMapsKey(): string
    {
        return (string) $this->_scopeConfig->getValue(
            "kumar_storelocator/general/google_maps_key",
            ScopeInterface::SCOPE_STORE
        );
    }
    public function getMapConfig(): array
    {
        $config = [];
        foreach (
            [
                "default_latitude",
                "default_longitude",
                "default_radius",
                "default_marker",
                "active_marker",
            ]
            as $key
        ) {
            $config[$key] = $this->_scopeConfig->getValue(
                "kumar_storelocator/map/" . $key,
                ScopeInterface::SCOPE_STORE
            );
        }
        foreach (["default_marker", "active_marker"] as $key) {
            if ($config[$key]) {
                $config[$key] = $this->getMediaUrl(ltrim($config[$key], "/"));
            }
        }
        return $config;
    }
    public function getMediaUrl(string $path): string
    {
        return $this->storeManager
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) .
            ltrim($path, "/");
    }
}
