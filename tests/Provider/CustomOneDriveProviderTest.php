<?php

declare(strict_types=1);

namespace App\Tests\Provider;

use Atico\SpreadsheetTranslator\Core\Provider\ProviderInterface;
use App\Provider\CustomOneDriveProvider;
use Atico\SpreadsheetTranslator\Core\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

final class CustomOneDriveProviderTest extends TestCase
{
    public function testGetProvider(): void
    {
        $configuration = $this->createConfigurationWithRealData();
        $provider = new CustomOneDriveProvider($configuration);

        $this->assertSame('onedrive', $provider->getProvider());
    }

    public function testProviderImplementsInterface(): void
    {
        $configuration = $this->createConfigurationWithRealData();
        $provider = new CustomOneDriveProvider($configuration);

        $this->assertInstanceOf(ProviderInterface::class, $provider);
    }

    public function testProviderCanBeInstantiated(): void
    {
        $configuration = $this->createConfigurationWithRealData();
        $provider = new CustomOneDriveProvider($configuration);

        $this->assertInstanceOf(CustomOneDriveProvider::class, $provider);
    }

    private function createConfigurationWithRealData(): Configuration
    {
        // Create a real Configuration object with proper structure to avoid vendor warnings
        $configurationData = [
            'frontend' => [
                'provider' => [
                    'name' => 'one_drive',
                    'source_resource' => 'https://onedrive.live.com/embed?resid=test',
                ],
                'exporter' => [
                    'format' => 'xliff',
                    'prefix' => 'demo_',
                    'destination_folder' => '/tmp/translations',
                ],
                'shared' => [
                    'temp_local_source_file' => '/tmp/test.xlsx',
                    'default_locale' => 'en',
                    'name_separator' => '#',
                ],
            ],
        ];

        return new Configuration($configurationData, 'provider');
    }
}
