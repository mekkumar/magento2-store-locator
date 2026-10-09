<?php
namespace Kumar\StoreLocator\Block\Adminhtml\System\Config;
class StoresLink extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(
        \Magento\Framework\Data\Form\Element\AbstractElement $element
    ) {
        $url = $this->getUrl("storelocator/store/index");
        return '<a class="action-default" target="_blank" href="' .
            $this->escapeUrl($url) .
            '">Open Store Management</a>';
    }
}
