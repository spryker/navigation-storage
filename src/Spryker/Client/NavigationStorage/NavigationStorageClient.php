<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\NavigationStorage;

use Generated\Shared\Transfer\NavigationStorageTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Spryker\Client\NavigationStorage\NavigationStorageFactory getFactory()
 */
class NavigationStorageClient extends AbstractClient implements NavigationStorageClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $navigationKey
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\NavigationStorageTransfer|null
     */
    public function findNavigationTreeByKey($navigationKey, $localeName)
    {
        return $this->getFactory()
            ->createNavigationStorage()
            ->findNavigationTreeByNavigationKey($navigationKey, $localeName);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\NavigationStorageTransfer $navigationStorageTransfer
     * @param string $navigationKey
     * @param string $localeName
     *
     * @return void
     */
    public function saveNavigationTree(NavigationStorageTransfer $navigationStorageTransfer, string $navigationKey, string $localeName): void
    {
        $this->getFactory()
            ->createNavigationStorage()
            ->saveNavigationTree($navigationStorageTransfer, $navigationKey, $localeName);
    }
}
