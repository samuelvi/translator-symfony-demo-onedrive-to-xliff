<?php

declare(strict_types=1);

namespace App\Provider;

use GuzzleHttp\Client;
use Atico\SpreadsheetTranslator\Core\Configuration\Configuration;
use Atico\SpreadsheetTranslator\Core\Resource\Resource;
use Atico\SpreadsheetTranslator\Core\Provider\ProviderInterface;
use Atico\SpreadsheetTranslator\Provider\OneDrive\OneDriveConfigurationManager;

class CustomOneDriveProvider implements ProviderInterface
{
    protected OneDriveConfigurationManager $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = new OneDriveConfigurationManager($configuration);
    }

    public function getProvider(): string
    {
        return 'onedrive';
    }

    public function handleSourceResource(): Resource
    {
        $url = str_replace('/embed', '/download', $this->configuration->getSourceResource());
        $tempLocalResource = $this->configuration->getTempLocalSourceFile();

        // Add browser-like headers to avoid OneDrive blocking the request
        $options = [
            'sink' => $tempLocalResource,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.5',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Connection' => 'keep-alive',
                'Upgrade-Insecure-Requests' => '1',
            ],
            'verify' => true,
            'allow_redirects' => true,
        ];

        $guzzleHttpClient = new Client();
        $guzzleHttpClient->get($url, $options);

        return new Resource($tempLocalResource, $this->configuration->getFormat());
    }
}
