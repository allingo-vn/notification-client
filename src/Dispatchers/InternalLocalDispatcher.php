<?php

namespace AllinGo\NotificationsClient\Dispatchers;

use AllinGo\NotificationsClient\Contracts\DispatcherInterface;
use InvalidArgumentException;
use Illuminate\Contracts\Container\Container;

class InternalLocalDispatcher implements DispatcherInterface
{
    public function __construct(
        private Container $container,
        private array $config
    ) {}

    public function dispatch(
        string $code,
        array $payload,
        ?array $overrideChannels = null,
        ?array $overrideAudience = null,
        ?string $locale = null
    ): array {
        $svcId  = $this->config['internal']['service'] ?? null;
        $method = $this->config['internal']['method']  ?? 'dispatchCode';

        if (!$svcId) {
            throw new InvalidArgumentException(
                'Internal dispatcher service not configured (notifications_client.internal.service).'
            );
        }

        $service = $this->container->make($svcId);

        if (!method_exists($service, $method)) {
            throw new InvalidArgumentException("Internal dispatcher method [$method] not found on [$svcId].");
        }

        return $service->$method(
            code: $code,
            data: $payload,
            overrideChannels: $overrideChannels,
            overrideAudience: $overrideAudience,
            locale: $locale
        );
    }
}
