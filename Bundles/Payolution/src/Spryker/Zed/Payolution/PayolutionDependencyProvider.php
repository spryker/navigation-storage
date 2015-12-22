<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Payolution;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Payolution\Dependency\Facade\PayolutionToGlossaryBridge;
use Spryker\Zed\Payolution\Dependency\Facade\PayolutionToMailBridge;

class PayolutionDependencyProvider extends AbstractBundleDependencyProvider
{

    const FACADE_MAIL = 'mail facade';
    const FACADE_GLOSSARY = 'glossary facade';

    /**
     * @param Container $container
     *
     * @return Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container[self::FACADE_MAIL] = function (Container $container) {
            return new PayolutionToMailBridge($container->getLocator()->mail()->facade());
        };

        $container[self::FACADE_GLOSSARY] = function (Container $container) {
            return new PayolutionToGlossaryBridge($container->getLocator()->glossary()->facade());
        };

        return $container;
    }

}