<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\NavigationStorage;

use Generated\Shared\Transfer\NavigationStorageTransfer;

interface NavigationStorageClientInterface
{
    /**
     * Specification:
     * - Finds navigation tree in the Key-Value Storage.
     * - Returns the navigation tree with all the stored data if found, NULL otherwise.
     *
     * @api
     *
     * @param string $navigationKey
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\NavigationStorageTransfer|null
     */
    public function findNavigationTreeByKey($navigationKey, $localeName);

    /**
     * Specification:
     * - Saves navigation tree to the Key-Value Storage.
     * - Updates existing navigation tree with rendered content and hash.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\NavigationStorageTransfer $navigationStorageTransfer
     * @param string $navigationKey
     * @param string $localeName
     *
     * @return void
     */
    public function saveNavigationTree(NavigationStorageTransfer $navigationStorageTransfer, string $navigationKey, string $localeName): void;
}
