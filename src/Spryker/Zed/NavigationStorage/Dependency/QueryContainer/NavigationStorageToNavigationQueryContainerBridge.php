<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\NavigationStorage\Dependency\QueryContainer;

use Orm\Zed\Navigation\Persistence\SpyNavigationQuery;

class NavigationStorageToNavigationQueryContainerBridge implements NavigationStorageToNavigationQueryContainerInterface
{
    /**
     * @var \Spryker\Zed\Navigation\Persistence\NavigationQueryContainerInterface
     */
    protected $navigationQueryContainer;

    /**
     * @param \Spryker\Zed\Navigation\Persistence\NavigationQueryContainerInterface $navigationQueryContainer
     */
    public function __construct($navigationQueryContainer)
    {
        $this->navigationQueryContainer = $navigationQueryContainer;
    }

    /**
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery
     */
    public function queryNavigationNode()
    {
        return $this->navigationQueryContainer->queryNavigationNode();
    }

    public function queryNavigation(): SpyNavigationQuery
    {
        return $this->navigationQueryContainer->queryNavigation();
    }
}
