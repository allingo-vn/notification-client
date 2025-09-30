<?php

namespace AllinGo\NotificationsClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \AllinGo\NotificationsClient\Domains\OnboardingNotifier onboarding()
 * @method static \AllinGo\NotificationsClient\Domains\OrdersNotifier orders()
 */
class AllingoNotifier extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AllinGo\NotificationsClient\Notifier::class;
    }
}
