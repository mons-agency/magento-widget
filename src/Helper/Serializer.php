<?php
/**
 * Copyright Mons Agency Ltd. Some rights reserved.
 * See copying.md for details.
 */

namespace Mons\Widget\Helper;

use Magento\Framework\Serialize\Serializer\Json;

class Serializer
{
    const QUOTE_REPLACEMENT = '||';

    /**
     * @param Json $serializer
     */
    public function __construct(
        protected Json $serializer
    )
    {
    }

    /**
     * @param array $value
     * @return string
     */
    public function serialize(array $value): string {
        return str_replace('"', self::QUOTE_REPLACEMENT, $this->serializer->serialize($value));
    }

    /**
     * @param string $value
     * @return array
     */
    public function unserialize(string $value): array {
        $value = str_replace(self::QUOTE_REPLACEMENT, '"', urldecode($value));
        $result = $this->serializer->unserialize($value);

        if (!is_array($result)) {
            throw new \RuntimeException('Unserialized object is not an array of values.');
        }

        return array_filter($result, fn($k) => $k !== '__empty', ARRAY_FILTER_USE_KEY);
    }
}
