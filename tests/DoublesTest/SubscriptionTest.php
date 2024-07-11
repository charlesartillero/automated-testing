<?php

namespace Tests\DoublesTest;

use App\Doubles\Gateway;
use App\Doubles\Mailer;
use App\Doubles\Subscription;
use App\Doubles\User;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{
    function test_it_creates_a_stripe_subscription()
    {
        $this->markTestSkipped();
    }

    function test_creating_a_subscription_marks_the_user_as_subscribed()
    {

        $gateway = $this->createMock(Gateway::class);
        $subscription = new Subscription($gateway, $this->createMock(Mailer::class));

        $user = new User('John Doe');
        $this->assertFalse($user->isSubscribed());

        $subscription->create($user);
        $this->assertTrue($user->isSubscribed());
    }


    function test_it_delivers_a_receipt()
    {
        $gateway = $this->createMock(Gateway::class);
        $gateway->method('create')->willReturn('receipt-stub');

        $mailer = $this->createMock(Mailer::class);
        $mailer
            ->expects($this->once())
            ->method('send')
            ->with('receipt-stub');

        $subscription = new Subscription($gateway, $mailer);

        $subscription->create(new User('John Doe'));

    }

}