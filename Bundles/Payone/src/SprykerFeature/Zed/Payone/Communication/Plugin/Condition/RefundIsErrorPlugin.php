<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Zed\Payone\Communication\Plugin\Condition;

use Generated\Shared\Transfer\OrderTransfer;
use SprykerFeature\Zed\Payone\Business\PayoneFacade;

/**
 * @method PayoneFacade getFacade()
 */
class RefundIsErrorPlugin extends AbstractPlugin
{

    const NAME = 'RefundIsErrorPlugin';

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return bool
     */
    protected function callFacade(OrderTransfer $orderTransfer)
    {
        return $this->getFacade()->isRefundError($orderTransfer);
    }

}