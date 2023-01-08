# Magento 2 - Widget module

Adds new parameter types for improved widget definition experience in Magento 2.

## Parameter types

* [x] Image selector field
* [x] Textarea field
* [x] Wysiwyg field
* [ ] Repetable fields (in progress)

## Installation

1. Install module via composer `composer require mons/module-m2-widget`
2. Register module `php bin/magento setup:upgrade`

## Usage examples

### Image Selector

```xml
<parameter xsi:type="block" name="background_image" visible="true" sort_order="10">
    <label translate="true">Background Image</label>
    <block class="Mons\Widget\Block\Adminhtml\Widget\Type\ImageChooser">
        <data>
            <item name="button" xsi:type="array">
                <item name="open" xsi:type="string">Choose Image...</item>
            </item>
        </data>
    </block>
</parameter>
```

### Textarea

```xml
<parameter xsi:type="block" name="body_text" visible="true" sort_order="10">
    <label translate="true">Body Text</label>
    <block class="Mons\Widget\Block\Adminhtml\Widget\Type\Textarea" />
</parameter>
```

### Wysiwyg

```xml
<parameter xsi:type="block" name="body_text" visible="true" sort_order="10">
    <label translate="true">Body Text</label>
    <block class="Mons\Widget\Block\Adminhtml\Widget\Type\Wysiwyg">
        <!-- optional TinyMCE config -->
        <data>
            <item name="toolbar" xsi:type="string">bold italic underline</item>
            <item name="plugins" xsi:type="string">link</item>
        </data>
    </block>
</parameter>
```

## Tested working with

* Magento 2.4
* PHP 8.1

## Contribution

* Fork this repository
* Create your feature branch (`git checkout -b feature/your-new-feature`) or a bugfix branch (`git checkout -b bugfix/bug-short-description`) *always* from `develop`
* Commit and submit a new Pull Request
