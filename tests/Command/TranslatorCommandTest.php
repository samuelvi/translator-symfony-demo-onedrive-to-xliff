<?php

declare(strict_types=1);

namespace App\Tests\Command;

use PHPUnit\Framework\MockObject\MockObject;
use ReflectionClass;
use App\Command\TranslatorCommand;
use Atico\SpreadsheetTranslator\Core\SpreadsheetTranslator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Contracts\Translation\TranslatorInterface;

final class TranslatorCommandTest extends TestCase
{
    private MockObject $spreadsheetTranslator;

    private MockObject $translator;

    private TranslatorCommand $command;

    protected function setUp(): void
    {
        $this->spreadsheetTranslator = $this->createMock(SpreadsheetTranslator::class);
        $this->translator = $this->getMockBuilder(TranslatorInterface::class)
            ->onlyMethods(['trans', 'getLocale'])
            ->addMethods(['setFallbackLocales'])
            ->getMock();

        $this->command = new TranslatorCommand(
            $this->spreadsheetTranslator,
            $this->translator
        );
    }

    public function testCommandConfiguration(): void
    {
        $this->assertSame('atico:demo:translator', $this->command->getName());
        $this->assertSame('Translate From an Excel File to Symfony Translation format', $this->command->getDescription());
    }

    public function testExecuteWithSheetNameOption(): void
    {
        $this->spreadsheetTranslator
            ->expects($this->once())
            ->method('processSheet')
            ->with('common', '');

        $this->translator
            ->expects($this->once())
            ->method('setFallbackLocales')
            ->with(['en', 'es_ES']);

        $this->translator
            ->expects($this->once())
            ->method('trans')
            ->with('homepage#title', [], 'demo_common')
            ->willReturn('Test Translation');

        $application = new Application();
        $application->add($this->command);

        $command = $application->find('atico:demo:translator');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            '--sheet-name' => 'common',
        ]);

        $this->assertSame(0, $commandTester->getStatusCode());
        $this->assertStringContainsString('Translation text for', $commandTester->getDisplay());
    }

    public function testExecuteWithSheetNameAndBookNameOptions(): void
    {
        $this->spreadsheetTranslator
            ->expects($this->once())
            ->method('processSheet')
            ->with('common', 'frontend');

        $this->translator
            ->expects($this->once())
            ->method('setFallbackLocales')
            ->with(['en', 'es_ES']);

        $this->translator
            ->expects($this->once())
            ->method('trans')
            ->with('homepage#title', [], 'demo_common')
            ->willReturn('Test Translation');

        $application = new Application();
        $application->add($this->command);

        $command = $application->find('atico:demo:translator');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            '--sheet-name' => 'common',
            '--book-name' => 'frontend',
        ]);

        $this->assertSame(0, $commandTester->getStatusCode());
    }

    public function testExecuteWithoutOptions(): void
    {
        $this->spreadsheetTranslator
            ->expects($this->once())
            ->method('processSheet')
            ->with('', '');

        $this->translator
            ->expects($this->once())
            ->method('setFallbackLocales');

        $this->translator
            ->expects($this->once())
            ->method('trans')
            ->willReturn('Test Translation');

        $application = new Application();
        $application->add($this->command);

        $command = $application->find('atico:demo:translator');
        $commandTester = new CommandTester($command);

        $commandTester->execute([]);

        $this->assertSame(0, $commandTester->getStatusCode());
    }

    public function testBuildParamsFromInput(): void
    {
        $reflection = new ReflectionClass($this->command);
        $reflection->getMethod('buildParamsFromInput');

        $application = new Application();
        $application->add($this->command);

        $command = $application->find('atico:demo:translator');
        $commandTester = new CommandTester($command);

        // Execute to get input
        $this->spreadsheetTranslator->expects($this->once())->method('processSheet');
        $this->translator->expects($this->once())->method('setFallbackLocales');
        $this->translator->expects($this->once())->method('trans')->willReturn('Test');

        $commandTester->execute([
            '--sheet-name' => 'test-sheet',
            '--book-name' => 'test-book',
        ]);

        // Test that command executed successfully
        $this->assertSame(0, $commandTester->getStatusCode());
    }
}
