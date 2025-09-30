<?php

namespace AllinGo\NotificationsClient\Contracts;

interface DispatcherInterface
{
    public function dispatch(
        string $code,
        array $payload,
        ?array $overrideChannels = null,
        ?array $overrideAudience = null,
        ?string $locale = null
    ): array;
}
