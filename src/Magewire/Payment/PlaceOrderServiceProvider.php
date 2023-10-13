<?php

namespace Snowdog\Hyva\Checkout\Santander\Magewire\Payment;

use Aurora\Santander\Model\Payment\SantanderConfigProvider;
use Hyva\Checkout\Model\Magewire\Payment\AbstractPlaceOrderService;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Model\Quote;

class PlaceOrderServiceProvider extends AbstractPlaceOrderService
{
    public function __construct(
        CartManagementInterface                  $cartManagement,
        private readonly SantanderConfigProvider $configProvider,
    ) {
        parent::__construct($cartManagement);
    }

    public function getRedirectUrl(Quote $quote, ?int $orderId = null): string
    {
        return $this->configProvider->getConfig()['santander']['redirect'];
    }
}