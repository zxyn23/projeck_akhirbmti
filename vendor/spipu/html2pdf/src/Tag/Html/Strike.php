<?php
/**
 * Html2Pdf Library - Tag class
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2025 Laurent MINGUET
 */
namespace Spipu\Html2Pdf\Tag\Html;

use Spipu\Html2Pdf\Tag\AbstractHtmlTag;

/**
 * Tag Strike
 */
class Strike extends AbstractHtmlTag
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'strike';
    }

    /**
     * @inheritdoc
     */
    protected function overrideStyles()
    {
        $this->parsingCss->value['font-linethrough'] = true;

        return $this;
    }
}
