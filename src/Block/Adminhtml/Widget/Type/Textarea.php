<?php
/**
 * Copyright Mons Agency Ltd. Some rights reserved.
 * See copying.md for details.
 */

namespace Mons\Widget\Block\Adminhtml\Widget\Type;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory as ElementFactory;

Class Textarea extends Template
{
    /**
     * @param ElementFactory $elementFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        protected ElementFactory $elementFactory,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Prepare chooser element HTML
     *
     * @param AbstractElement $element
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        $input = $this->elementFactory->create('textarea', ['data' => $element->getData()]);

        $input->setId($element->getId());
        $input->setForm($element->getForm());
        $input->setClass('widget-option input-textarea admin__control-text');

        if ($element->getRequired()) {
            $input->addClass('required-entry');
        }

        $element->setData('after_element_html', $input->getElementHtml());
        $element->setValue(''); // hides the additional label

        return $element;
    }
}
