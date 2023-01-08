<?php
/**
 * Copyright Mons Agency Ltd. Some rights reserved.
 * See copying.md for details.
 */

namespace Mons\Widget\Block\Adminhtml\Widget\Type;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Cms\Model\Wysiwyg\Config as WysiwygConfig;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory as ElementFactory;

Class Wysiwyg extends Template
{
    /**
     * @param ElementFactory $factoryElement
     * @param WysiwygConfig $wysiwygConfig
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        protected ElementFactory $factoryElement,
        protected WysiwygConfig $wysiwygConfig,
        Context $context,
        $data = []
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
        $toolbar = $this->getData('toolbar');
        $plugins = $this->getData('plugins');
        $config = $this->wysiwygConfig->getConfig([
            'add_variables' => false,
            'add_widgets' => false,
            'add_images' => false,
            'add_directives' => false
        ]);

        // override config
        if ($toolbar || $plugins) {
            $tinymce = $config->getData('tinymce');

            if ($toolbar) {
                $tinymce['toolbar'] = $toolbar;
            }

            if ($plugins) {
                $tinymce['plugins'] = $plugins;
            }

            $config->setData('tinymce', $tinymce);
        }

        $editor = $this->factoryElement->create('editor', ['data' => $element->getData()])
            ->setLabel('')
            ->setForm($element->getForm())
            ->setWysiwyg(true)
            ->setConfig($config);

        if ($element->getRequired()) {
            $editor->addClass('required-entry');
        }

        $element->setData('after_element_html', $editor->getElementHtml());
        $element->setValue(''); // hides the additional label

        return $element;
    }
}
