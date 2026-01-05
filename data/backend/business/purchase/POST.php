<?php

namespace business\purchase;

use config\ExternalServices\PaymentServer;
use config\ExternalServices\TemplateServer\pricing\Pricing;

/**
 * Handle user subscription
 * - username : username of the user
 * - template : template user wants to subscribe to
 * - period : during of the subscription
 */
class POST
{
    private string $username;
    private int $template;
    private int $period;
    private PaymentServer $paymentServer;

    function __construct(?string $username = null, ?int $template = null, ?int $period = null)
    {
        $this->username = $username;
        $this->template = $template;
        $this->period = $period;
        $this->paymentServer = PaymentServer::getInstance();
    }

    /**
     * This method calculates subtotal based on template and discount if possible for a certain duration of a subscription
     */
    private function calculateSubtotal(float $price = 0, int $discount = 0): float {
        return number_format($price * (1 - $discount / 100), 2);
    }

    /**
     * Call payment server to add purcharse
     * @return array
     */
    private function processPayment(float $total, int $template) {
        return [
            'success' => true,
            'customer' => $this->username,
            'product' => $template,
            'method' => 'credit',
            'subtotal' => $total,
            'total' => $total
        ];
    }

    private function addPurchase()
    {
        if($this->username === null || $this->template === null || $this->period === null) {
            throw new \Exception("either username, or template, or period is missing");
        }

        // Get pricing from template server and determine subtotal
        $prices = (new Pricing())->get();

        $hasPricing = false;
        foreach ($prices as $price) {
            if($price['period'] === $this->period) {
                $subtotal = $this->calculateSubtotal($price['price'], $price['discount']);
                $hasPricing = true;
                break;
            }
        }
        if(!$hasPricing) {
            throw new \Exception("There is no pricing with period of ". $this->period);
        }

        // Payment server processing...
        $payment = $this->processPayment($subtotal, $this->template);
        if(!$payment['success']) {
            throw new \Exception("There is problem processing your payment");
        }

        return true;
    }

    public function execute()
    {
        return $this->addPurchase();
    }
}
