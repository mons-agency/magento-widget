<?php
/**
 * Copyright Mons Agency Ltd. Some rights reserved.
 * See copying.md for details.
 */

namespace Mons\Widget\Plugin\Block\Adminhtml\Wysiwyg\Images;

use Magento\Cms\Block\Adminhtml\Wysiwyg\Images\Content;
use Magento\Framework\App\RequestInterface;

class ContentPlugin
{
    /**
     * @param RequestInterface $request
     */
    public function __construct(
        private RequestInterface $request
    )
    {
    }

    /**
     * @param Content $subject
     * @param string $result
     * @return string
     */
    public function afterGetOnInsertUrl(Content $subject, string $result)
    {
        $onInsertUrl = $this->request->getParam('on_insert_url');

        return $onInsertUrl ? urldecode($onInsertUrl) : $result;
    }
}
