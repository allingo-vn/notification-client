<?php

namespace AllinGo\NotificationsClient\Enums;

enum NotificationCode: string
{
    case Test_SampleNotification = 'test.sample.notification';
    case Onboarding_EmailVerification = 'onboarding.account_created.email_verification';
    case Onboarding_OtpSms            = 'onboarding.account_created.otp_sms';

    case Order_DeliveryFailed         = 'order.delivery_failed';
    case Order_DeliveredSuccess       = 'order.delivered.success';
    case Order_StatusChanged          = 'order.status.changed';
}
