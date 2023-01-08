<?php
/**
 * Copyright Mons Agency Ltd. Some rights reserved.
 * See copying.md for details.
 */

namespace Mons\Widget\Plugin\Model;

use Magento\Widget\Model\Widget;
use Mons\Widget\Helper\Serializer;

class WidgetPlugin
{
    /**
     * @param Serializer $serializer
     */
    public function __construct(
        private Serializer $serializer
    )
    {
    }

    /**
     * @param Widget $subject
     * @param string $type
     * @param array $params
     * @param bool $asIs
     * @return array
     */
    public function beforeGetWidgetDeclaration(Widget $subject, string $type, array $params, bool $asIs) {
        foreach ($params as $name => $value) {
            if (strpos($name, 'repeatable_') !== false) {
                $params[$name] = $this->serializer->serialize($value);
            }
        }

        return [$type, $params, $asIs];
    }
}
