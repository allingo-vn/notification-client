<?php

namespace AllinGo\NotificationsClient\Dispatchers;

use AllinGo\NotificationsClient\Contracts\DispatcherInterface;
use GuzzleHttp\Client;

class ExternalHttpDispatcher implements DispatcherInterface
{
    public function __construct(private array $config) {}

    public function dispatch(
        string $code,
        array $payload,
        ?array $overrideChannels = null,
        ?array $overrideAudience = null,
        ?string $locale = null
    ): array {
        $base    = rtrim($this->config['external']['base_url'] ?? '', '/');
        $token   = $this->config['external']['token'] ?? null;
        $timeout = (int)($this->config['external']['timeout'] ?? 5);

        $client = new Client(['base_uri' => $base, 'timeout' => $timeout]);

        $res = $client->post('/api/notifications/dispatch', [
            'headers' => $token ? ['Authorization' => "Bearer {$token}"] : [],
            'json'    => [
                'code'              => $code,
                'data'              => $payload,
                'override_channels' => $overrideChannels,
                'override_audience' => $overrideAudience,
                'locale'            => $locale,
            ],
        ]);

        return json_decode((string) $res->getBody(), true) ?? [];
    }
}
