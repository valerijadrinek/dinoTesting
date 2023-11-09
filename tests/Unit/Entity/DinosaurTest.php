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

    public function testIsAcceptingVisitorsByDefault() : void
    {
        $dino = new Dinosaur(name: 'Dennis');
        self::assertTrue($dino->isAcceptingVisitors());
    }

    public function testIsNotAcceptingVisitorsIfSick() : void
    {
        $dino = new Dinosaur('Bumpy');
        $dino->setHealth(HealthStatus::SICK);
        self::assertFalse($dino->isAcceptingVisitors());
    }
    

    public function sizeDescriptionProvider() : \Generator
    {
        yield 'Large Dino' => [10, 'Large'];
        yield 'Medium Dino' => [5, 'Medium'];
        yield 'Small Dino' => [4, 'Small'];
    }
}