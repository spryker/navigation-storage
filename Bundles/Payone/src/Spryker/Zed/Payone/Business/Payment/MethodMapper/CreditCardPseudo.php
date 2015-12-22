<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Payone\Business\Payment\MethodMapper;

use Generated\Shared\Transfer\PayoneAuthorizationTransfer;
use Generated\Shared\Transfer\PayoneCreditCardTransfer;
use Spryker\Zed\Payone\Business\Api\Request\Container\Authorization\AbstractAuthorizationContainer;
use Spryker\Zed\Payone\Business\Api\Request\Container\Authorization\PaymentMethod\CreditCardPseudoContainer;
use Spryker\Zed\Payone\Business\Api\Request\Container\Authorization\PersonalContainer;
use Spryker\Zed\Payone\Business\Api\Request\Container\AuthorizationContainer;
use Spryker\Zed\Payone\Business\Api\Request\Container\CaptureContainer;
use Spryker\Zed\Payone\Business\Api\Request\Container\CreditCardCheckContainer;
use Spryker\Zed\Payone\Business\Api\Request\Container\DebitContainer;
use Spryker\Zed\Payone\Business\Api\Request\Container\PreAuthorizationContainer;
use Spryker\Shared\Payone\PayoneApiConstants;
use Spryker\Zed\Payone\Business\Api\Request\Container\RefundContainer;
use Orm\Zed\Payone\Persistence\SpyPaymentPayone;

class CreditCardPseudo extends AbstractMapper
{

    /**
     * @return string
     */
    public function getName()
    {
        return PayoneApiConstants::PAYMENT_METHOD_CREDITCARD_PSEUDO;
    }

    /**
     * @param SpyPaymentPayone $paymentEntity
     *
     * @return AuthorizationContainer
     */
    public function mapPaymentToAuthorization(SpyPaymentPayone $paymentEntity)
    {
        $authorizationContainer = new AuthorizationContainer();
        $authorizationContainer = $this->mapPaymentToAbstractAuthorization($paymentEntity, $authorizationContainer);

        return $authorizationContainer;
    }

    /**
     * @param SpyPaymentPayone $paymentEntity
     *
     * @return CaptureContainer
     */
    public function mapPaymentToCapture(SpyPaymentPayone $paymentEntity)
    {
        $paymentDetailEntity = $paymentEntity->getSpyPaymentPayoneDetail();

        $captureContainer = new CaptureContainer();
        $captureContainer->setAmount($paymentDetailEntity->getAmount());
        $captureContainer->setCurrency($this->getStandardParameter()->getCurrency());
        $captureContainer->setTxid($paymentEntity->getTransactionId());

        return $captureContainer;
    }

    /**
     * @param SpyPaymentPayone $paymentEntity
     *
     * @return PreAuthorizationContainer
     */
    public function mapPaymentToPreAuthorization(SpyPaymentPayone $paymentEntity)
    {
        $preAuthorizationContainer = new PreAuthorizationContainer();
        $preAuthorizationContainer = $this->mapPaymentToAbstractAuthorization($paymentEntity, $preAuthorizationContainer);

        return $preAuthorizationContainer;
    }

    /**
     * @param SpyPaymentPayone $paymentEntity
     * @param AbstractAuthorizationContainer $authorizationContainer
     *
     * @return AbstractAuthorizationContainer
     */
    protected function mapPaymentToAbstractAuthorization(SpyPaymentPayone $paymentEntity, AbstractAuthorizationContainer $authorizationContainer)
    {
        $paymentDetailEntity = $paymentEntity->getSpyPaymentPayoneDetail();

        $authorizationContainer->setAid($this->getStandardParameter()->getAid());
        $authorizationContainer->setClearingType(PayoneApiConstants::CLEARING_TYPE_CREDIT_CARD);
        $authorizationContainer->setReference($paymentEntity->getReference());
        $authorizationContainer->setAmount($paymentDetailEntity->getAmount());
        $authorizationContainer->setCurrency($this->getStandardParameter()->getCurrency());
        $authorizationContainer->setPaymentMethod($this->createPaymentMethodContainerFromPayment($paymentEntity));

        $billingAddressEntity = $paymentEntity->getSpySalesOrder()->getBillingAddress();

        $personalContainer = new PersonalContainer();
        $this->mapBillingAddressToPersonalContainer($personalContainer, $billingAddressEntity);

        $authorizationContainer->setPersonalData($personalContainer);

        return $authorizationContainer;
    }

    /**
     * @param PayoneCreditCardTransfer $payoneCreditCardTransfer
     *
     * @return CreditCardCheckContainer
     */
    public function mapCreditCardCheck(PayoneCreditCardTransfer $payoneCreditCardTransfer)
    {
        $creditCardCheckContainer = new CreditCardCheckContainer();

        $creditCardCheckContainer->setAid($this->getStandardParameter()->getAid());
        $creditCardCheckContainer->setCardPan($payoneCreditCardTransfer->getCardPan());
        $creditCardCheckContainer->setCardType($payoneCreditCardTransfer->getCardType());
        $creditCardCheckContainer->setCardExpireDate($payoneCreditCardTransfer->getCardExpireDate());
        $creditCardCheckContainer->setCardCvc2($payoneCreditCardTransfer->getCardCvc2());
        $creditCardCheckContainer->setCardIssueNumber($payoneCreditCardTransfer->getCardIssueNumber());
        $creditCardCheckContainer->setStoreCardData($payoneCreditCardTransfer->getStoreCardData());
        $creditCardCheckContainer->setLanguage($this->getStandardParameter()->getLanguage());

        return $creditCardCheckContainer;
    }

    /**
     * @param SpyPaymentPayone $paymentEntity
     *
     * @return DebitContainer
     */
    public function mapPaymentToDebit(SpyPaymentPayone $paymentEntity)
    {
        $debitContainer = new DebitContainer();

        $debitContainer->setTxid($paymentEntity->getTransactionId());
        $debitContainer->setSequenceNumber($this->getNextSequenceNumber($paymentEntity->getTransactionId()));
        $debitContainer->setCurrency($this->getStandardParameter()->getCurrency());
        $debitContainer->setAmount($paymentEntity->getSpyPaymentPayoneDetail()->getAmount());

        return $debitContainer;
    }

    /**
     * @param SpyPaymentPayone $paymentEntity
     *
     * @return RefundContainer
     */
    public function mapPaymentToRefund(SpyPaymentPayone $paymentEntity)
    {
        $refundContainer = new RefundContainer();

        $refundContainer->setTxid($paymentEntity->getTransactionId());
        $refundContainer->setSequenceNumber($this->getNextSequenceNumber($paymentEntity->getTransactionId()));
        $refundContainer->setCurrency($this->getStandardParameter()->getCurrency());

        return $refundContainer;
    }

    /**
     * @param SpyPaymentPayone $paymentEntity
     *
     * @return CreditCardPseudoContainer
     */
    protected function createPaymentMethodContainerFromPayment(SpyPaymentPayone $paymentEntity)
    {
        $paymentMethodContainer = new CreditCardPseudoContainer();

        $pseudoCardPan = $paymentEntity->getSpyPaymentPayoneDetail()->getPseudoCardPan();
        $paymentMethodContainer->setPseudoCardPan($pseudoCardPan);

        return $paymentMethodContainer;
    }

    /**
     * @param PayoneAuthorizationTransfer $payoneAuthorizationTransfer
     *
     * @return PersonalContainer
     */
    protected function createAuthorizationPersonalData(PayoneAuthorizationTransfer $payoneAuthorizationTransfer)
    {
        $personalContainer = new PersonalContainer();

        $personalContainer->setFirstName($payoneAuthorizationTransfer->getOrder()->getFirstName());
        $personalContainer->setLastName($payoneAuthorizationTransfer->getOrder()->getLastName());
        $personalContainer->setCountry($this->storeConfig->getCurrentCountry());

        return $personalContainer;
    }

}