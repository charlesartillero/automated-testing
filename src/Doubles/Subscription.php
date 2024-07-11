<?php

namespace App\Doubles;

class Subscription implements SubscriptionInterface
{
    protected GatewayInterface $gateway;
    protected Mailer $mailer;

    function __construct(GatewayInterface $gateway, Mailer $mailer)
    {
        $this->gateway = $gateway;
        $this->mailer = $mailer;
    }

    public function create(User $user)
    {
        $receipt = $this->gateway->create();

        $user->setAsSubscribed();

        $this->mailer->send($receipt);

    }
}