<?php

namespace App\Tests\Unit\Service;

use App\Enum\HealthStatus;
use PHPUnit\Framework\TestCase;
use App\Service\GithubService;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubServiceTest extends TestCase 
{
      /**
     * @dataProvider dinoNameProvider
     */
    public function testGetHealthReportReturnsCorrectHealthStatusForDino(HealthStatus $expectedStatus, string $dinoName): void
    {
        $mockLogger = $this->createMock(LoggerInterface::class);
        $mockHttpClient = $this->createMock(HttpClientInterface::class);
        $service = new GithubService($mockHttpClient,  $mockLogger);
        self::assertSame($expectedStatus, $service->getHealthReport($dinoName));
    }

    public function dinoNameProvider(): \Generator

    {

        yield "Sick Dino"=> [HealthStatus::SICK, 'Daisy'];
        yield "Healthy Dino"=> [HealthStatus::HEALTHY, 'Maverick'];
    }
}
