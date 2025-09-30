<?php

namespace AllinGo\NotificationsClient\Domains;

use AllinGo\NotificationsClient\Contracts\DispatcherInterface;
use AllinGo\NotificationsClient\Enums\NotificationCode;

class OrdersNotifier
{
    public function __construct(private DispatcherInterface $d) {}

    public function deliveryFailed(int $orderId, string $reason, ?int $shopId = null, ?int $userId = null, ?string $orderUrl = null, ?string $locale = null): array
    {
        return $this->d->dispatch(
            NotificationCode::Order_DeliveryFailed->value,
            ['order_id'=>$orderId, 'reason'=>$reason, 'shop_id'=>$shopId, 'user_id'=>$userId, 'order_url'=>$orderUrl],
            null, null, $locale
        );
    }

    public function deliveredSuccess(int $orderId, ?int $shopId = null, ?int $userId = null, ?string $orderUrl = null, ?string $locale = null): array
    {
        return $this->d->dispatch(
            NotificationCode::Order_DeliveredSuccess->value,
            ['order_id'=>$orderId, 'shop_id'=>$shopId, 'user_id'=>$userId, 'order_url'=>$orderUrl],
            null, null, $locale
        );
    }

    public function statusChanged(int $orderId, string $status, ?int $shopId = null, ?int $userId = null, ?string $orderUrl = null, ?string $locale = null): array
    {
        return $this->d->dispatch(
            NotificationCode::Order_StatusChanged->value,
            ['order_id'=>$orderId, 'status'=>$status, 'shop_id'=>$shopId, 'user_id'=>$userId, 'order_url'=>$orderUrl],
            null, null, $locale
        );
    }
}
