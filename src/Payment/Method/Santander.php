<?php

namespace Snowdog\Hyva\Checkout\Santander\Payment\Method;

use Hyva\Checkout\Model\Magewire\Component\EvaluationInterface;
use Hyva\Checkout\Model\Magewire\Component\EvaluationResultFactory;
use Hyva\Checkout\Model\Magewire\Component\EvaluationResultInterface;
use Magento\Checkout\Model\Session as SessionCheckout;
use Magewirephp\Magewire\Component;

class Santander extends Component implements EvaluationInterface
{
    public bool $acceptTos = false;

    public function __construct(
        private readonly SessionCheckout $sessionCheckout,
    ) {
    }

    public function evaluateCompletion(EvaluationResultFactory $resultFactory): EvaluationResultInterface
    {
        if ($this->sessionCheckout->getQuote()->getPayment()->getMethod() != 'eraty_santander') {
            return $resultFactory->createSuccess();
        }

        if (!$this->acceptTos) {
            return $resultFactory->createBlocking(__('TOS not accepted'));
        }

        return $resultFactory->createSuccess();
    }
}