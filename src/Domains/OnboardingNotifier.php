<?php

namespace AllinGo\NotificationsClient\Domains;

use AllinGo\NotificationsClient\Contracts\DispatcherInterface;
use AllinGo\NotificationsClient\Enums\NotificationCode;

class OnboardingNotifier
{
    public function __construct(private DispatcherInterface $d) {}

    public function sendAccountCreatedEmailVerification(int $userId, string $verifyUrl, ?string $locale = null): array
    {
        return $this->d->dispatch(
            NotificationCode::Onboarding_EmailVerification->value,
            ['user_id' => $userId, 'verify_url' => $verifyUrl],
            null, null, $locale
        );
    }

    public function sendAccountCreatedOtpSms(int $userId, string $otp, ?string $locale = null): array
    {
        return $this->d->dispatch(
            NotificationCode::Onboarding_OtpSms->value,
            ['user_id' => $userId, 'otp' => $otp],
            null, null, $locale
        );
    }
}
