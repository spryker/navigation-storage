<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Search\Plugin\Config;

use Generated\Shared\Transfer\SortConfigTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\Search\Dependency\Plugin\SortConfigBuilderInterface;

class SortConfigBuilder extends AbstractPlugin implements SortConfigBuilderInterface
{

    const DIRECTION_ASC = 'asc';
    const DIRECTION_DESC = 'desc';

    const DEFAULT_SORT_PARAM_KEY = 'sort';
    const DEFAULT_SORT_DIRECTION_PARAM_KEY = 'sort_order';

    /**
     * @var \Generated\Shared\Transfer\SortConfigTransfer[]
     */
    protected $sortConfigTransfers = [];

    /**
     * @var string
     */
    protected $sortParamKey;

    /**
     * @var string
     */
    protected $sortDirectionParamKey;

    /**
     * @param string $sortParamName
     * @param string $sortDirectionParamName
     */
    public function __construct($sortParamName = self::DEFAULT_SORT_PARAM_KEY, $sortDirectionParamName = self::DEFAULT_SORT_DIRECTION_PARAM_KEY)
    {
        $this->sortParamKey = $sortParamName;
        $this->sortDirectionParamKey = $sortDirectionParamName;
    }

    /**
     * @param \Generated\Shared\Transfer\SortConfigTransfer $sortConfigTransfer
     *
     * @return $this
     */
    public function addSort(SortConfigTransfer $sortConfigTransfer)
    {
        $this->assertSortConfigTransfer($sortConfigTransfer);

        $this->sortConfigTransfers[$sortConfigTransfer->getParameterName()] = $sortConfigTransfer;

        return $this;
    }

    /**
     * @param string $parameterName
     *
     * @return \Generated\Shared\Transfer\SortConfigTransfer|null
     */
    public function get($parameterName)
    {
        if (isset($this->sortConfigTransfers[$parameterName])) {
            return $this->sortConfigTransfers[$parameterName];
        }

        return null;
    }

    /**
     * @return \Generated\Shared\Transfer\SortConfigTransfer[]
     */
    public function getAll()
    {
        return $this->sortConfigTransfers;
    }

    /**
     * @param array $requestParameters
     *
     * @return string|null
     */
    public function getActiveParamName(array $requestParameters)
    {
        $sortParamName = array_key_exists($this->sortParamKey, $requestParameters) ? $requestParameters[$this->sortParamKey] : null;

        return $sortParamName;
    }

    /**
     * @param array $requestParameters
     *
     * @return string|null
     */
    public function getActiveSortDirection($requestParameters)
    {
        $direction = array_key_exists($this->sortDirectionParamKey, $requestParameters) ? $requestParameters[$this->sortDirectionParamKey] : self::DIRECTION_ASC;

        return $direction;
    }

    /**
     * @param \Generated\Shared\Transfer\SortConfigTransfer $sortConfigTransfer
     *
     * @throws \Spryker\Shared\Transfer\Exception\RequiredTransferPropertyException
     *
     * @return void
     */
    protected function assertSortConfigTransfer(SortConfigTransfer $sortConfigTransfer)
    {
        $sortConfigTransfer
            ->requireName()
            ->requireParameterName()
            ->requireFieldName();
    }

}