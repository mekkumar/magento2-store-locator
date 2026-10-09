<?php

namespace Kumar\StoreLocator\Controller\Adminhtml\Store;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Kumar\StoreLocator\Model\StoreFactory;

class Save extends Action
{
    const ADMIN_RESOURCE = 'Kumar_StoreLocator::storelocator';

    private $storeFactory;
    private $uploaderFactory;
    private $filesystem;

    public function __construct(
        Action\Context $context,
        StoreFactory $storeFactory,
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->storeFactory = $storeFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            return $this->_redirect('*/*/index');
        }

        try {
            $model = $this->storeFactory->create();

            $id = (int) ($data['entity_id'] ?? 0);

            if ($id) {
                $model->load($id);

                if (!$model->getId()) {
                    throw new \Magento\Framework\Exception\LocalizedException(
                        __('Store does not exist.')
                    );
                }
            }

            unset($data['form_key'], $data['entity_id']);

            $media = $this->filesystem->getDirectoryWrite(
                DirectoryList::MEDIA
            );

            $dir = 'kumar/storelocator/stores';
            $media->create($dir);

            foreach (['logo', 'marker_icon', 'active_marker_icon'] as $field) {
                if (empty($_FILES[$field]['name'])) {
                    unset($data[$field]);
                    continue;
                }

                $uploader = $this->uploaderFactory->create([
                    'fileId' => $field
                ]);

                $uploader->setAllowedExtensions([
                    'jpg', 'jpeg', 'png', 'gif', 'webp'
                ]);

                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $result = $uploader->save(
                    $media->getAbsolutePath($dir)
                );

                if ($result && !empty($result['file'])) {
                    $data[$field] = $dir . '/' . $result['file'];
                }
            }

            $model->addData($data);

            if (!$model->getCode()) {
                $model->setCode(
                    'store-' . substr(
                        sha1(($data['name'] ?? 'store') . microtime(true)),
                        0,
                        12
                    )
                );
            }

            $model->save();

            $savedId = $model->getId();

            $this->_objectManager
                ->get(\Psr\Log\LoggerInterface::class)
                ->info('StoreLocator save debug', [
                    'entity_id' => $savedId,
                    'name' => $model->getName()
                ]);

            $this->messageManager->addSuccessMessage(
                __('Store saved successfully. Debug ID: %1', $savedId ?: 'EMPTY')
            );

            return $this->_redirect('*/*/index');

        } catch (\Exception $e) {
            $this->_objectManager
                ->get(\Psr\Log\LoggerInterface::class)
                ->critical('StoreLocator save failed: ' . $e->getMessage());

            $this->messageManager->addErrorMessage(
                __('Unable to save store: %1', $e->getMessage())
            );

            return $this->_redirect(
                '*/*/edit',
                ['id' => (int) ($data['entity_id'] ?? 0)]
            );
        }
    }
}