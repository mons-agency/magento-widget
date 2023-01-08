<?php
/**
 * Copyright Mons Agency Ltd. Some rights reserved.
 * See copying.md for details.
 */

namespace Mons\Widget\Controller\Adminhtml\Wysiwyg\Images;

use Magento\Backend\App\Action\Context;
use Magento\Cms\Controller\Adminhtml\Wysiwyg\Images as ParentController;
use Magento\Cms\Helper\Wysiwyg\Images as Helper;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;

class OnInsert extends ParentController
{
    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param RawFactory $resultRawFactory
     * @param Helper $imagesHelper
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        protected RawFactory $resultRawFactory,
        protected Helper $imagesHelper
    ) {
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Fire when select image
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $filename = $this->getRequest()->getParam('filename');
        $image = $this->getImagePath($filename);

        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->resultRawFactory->create();

        return $resultRaw->setContents($image);
    }

    /**
     * Prepare Image insertion declaration for Wysiwyg or textarea
     *
     * @param string $filename
     * @return string
     */
    private function getImagePath(string $filename)
    {
        $fileId = $this->imagesHelper->idDecode($filename);
        $fileUrl = $this->imagesHelper->getCurrentUrl() . $fileId;
        $mediaUrl = $this->_url->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

        return str_replace($mediaUrl, '', $fileUrl);
    }
}
