<?php

namespace AllinGo\NotificationsClient\Domains;

use AllinGo\NotificationsClient\Contracts\DispatcherInterface;
use AllinGo\NotificationsClient\Enums\NotificationCode;

class TestNotifier
{
    public function __construct(private DispatcherInterface $d) {}

    public function sampleNotification(int $orderId, string $reason): array
    {
        return $this->d->dispatch(
            NotificationCode::Test_SampleNotification->value,
            ['order_id'=>$orderId, 'reason'=>$reason,],
        );
    }
}
