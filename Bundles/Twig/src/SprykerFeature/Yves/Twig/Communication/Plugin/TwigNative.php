<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Yves\Twig\Communication\Plugin;

use SprykerEngine\Yves\Kernel\Communication\AbstractPlugin;
use SprykerFeature\Yves\Twig\Communication\Dependency\Plugin\TwigFilterPluginInterface;

class TwigNative extends AbstractPlugin implements TwigFilterPluginInterface
{

    /**
     * @return \Twig_SimpleFilter[]
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('floor', function ($value) {
                return floor($value);
            }),
            new \Twig_SimpleFilter('ceil', function ($value) {
                return ceil($value);
            }),
            new \Twig_SimpleFilter('int', function ($value) {
                return (int) $value;
            }),
        ];
    }

}