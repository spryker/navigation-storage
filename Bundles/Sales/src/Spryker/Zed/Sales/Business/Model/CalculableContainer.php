<?php

namespace Spryker\Zed\Sales\Business\Model;

use Spryker\Zed\Calculation\Business\Model\CalculableInterface;
use Generated\Shared\Transfer\CalculableContainerTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class CalculableContainer implements CalculableInterface
{

    /**
     * @var OrderTransfer
     */
    private $order;

    /**
     * @param OrderTransfer $order
     */
    public function __construct(OrderTransfer $order)
    {
        $this->order = $order;
    }

    /**
     * @return CalculableContainerTransfer
     */
    public function getCalculableObject()
    {
        return $this->order;
    }

}