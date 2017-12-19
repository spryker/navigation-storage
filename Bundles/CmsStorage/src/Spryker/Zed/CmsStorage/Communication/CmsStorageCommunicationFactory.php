<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsStorage\Communication;

use Spryker\Zed\CmsStorage\CmsStorageDependencyProvider;
use Spryker\Zed\CmsStorage\Dependency\Facade\CmsStorageToEventBehaviorFacadeInterface;
use Spryker\Zed\CmsStorage\Dependency\Service\CmsStorageToUtilSanitizeServiceInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \Spryker\Zed\CmsStorage\Persistence\CmsStorageQueryContainer getQueryContainer()
 * @method \Spryker\Zed\CmsStorage\CmsStorageConfig getConfig()
 */
class CmsStorageCommunicationFactory extends AbstractCommunicationFactory
{

    /**
     * @return CmsStorageToUtilSanitizeServiceInterface
     */
    public function getUtilSanitizeService()
    {
        return $this->getProvidedDependency(CmsStorageDependencyProvider::SERVICE_UTIL_SANITIZE);
    }

    /**
     * @return CmsStorageToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade()
    {
        return $this->getProvidedDependency(CmsStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
    /**
     * @return \Spryker\Zed\CmsStorage\Dependency\Facade\CmsStorageToCmsInterface
     */
    public function getCmsFacade()
    {
        return $this->getProvidedDependency(CmsStorageDependencyProvider::FACADE_CMS);
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStore()
    {
        return $this->getProvidedDependency(CmsStorageDependencyProvider::STORE);
    }

}