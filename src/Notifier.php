<?php

namespace AllinGo\NotificationsClient;

use AllinGo\NotificationsClient\Contracts\DispatcherInterface;
use AllinGo\NotificationsClient\Domains\OnboardingNotifier;
use AllinGo\NotificationsClient\Domains\OrdersNotifier;
use AllinGo\NotificationsClient\Domains\TestNotifier;

class Notifier
{
    public function __construct(private DispatcherInterface $dispatcher) {}

    public function test(): TestNotifier
    {
        return new TestNotifier($this->dispatcher);
    }

    public function onboarding(): OnboardingNotifier
    {
        return new OnboardingNotifier($this->dispatcher);
    }

    public function orders(): OrdersNotifier
    {
        return new OrdersNotifier($this->dispatcher);
    }
}
