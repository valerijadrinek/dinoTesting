<?php
declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Dinosaur;
use PHPUnit\Framework\TestCase;
use App\Enum\HealthStatus;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;


class DinosaurTest extends TestCase 
{
    public function testCanGetAndSetData(): void
    {
        $dino = new Dinosaur(
            name: 'Big Eaty',
            genus: 'Tyrannosaurus',
            length: 12,
            enclosure: 'Paddock A',
        );

       

        self::assertSame('Big Eaty', $dino->getName());
        self::assertSame('Tyrannosaurus', $dino->getGenus());
        self::assertSame(12, $dino->getLength());
        self::assertSame('Paddock A', $dino->getEnclosure());
    }

   /**
    *  @dataProvider sizeDescriptionProvider
    */
    public function testDinoHasCorrectSizeDescriptionFromLength(int $length, string $expectedSize): void
    {
        $dino = new Dinosaur(name: 'Big Eaty', length: $length);

        self::assertSame($expectedSize, $dino->getSizeDescription(), 'This is supposed to be a large Dinosaur');
    }

   
    public function testIsAcceptingVisitorsByDefault(): void
    {
        $dino = new Dinosaur('Dennis');
        self::assertTrue($dino->isAcceptingVisitors());
    }
 /**
     * @dataProvider healthStatusProvider
     */
    public function testIsAcceptingVisitorsBasedOnHealthStatus(HealthStatus $healthStatus, bool $expectedVisitorStatus): void
    {
        $dino = new Dinosaur('Bumpy');
        $dino->setHealth($healthStatus);
        self::assertSame($expectedVisitorStatus, $dino->isAcceptingVisitors());
    }
    public function healthStatusProvider(): \Generator
    {
        yield 'Sick dino is not accepting visitors' => [HealthStatus::SICK, false];
        yield 'Hungry dino is accepting visitors' => [HealthStatus::HUNGRY, true];
    }
    

    public function sizeDescriptionProvider() : \Generator
    {
        yield 'Large Dino' => [10, 'Large'];
        yield 'Medium Dino' => [5, 'Medium'];
        yield 'Small Dino' => [4, 'Small'];
    }

   
}