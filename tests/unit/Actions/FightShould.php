<?php

use Sensorario\DnD\Actions\Fight;
use Sensorario\DnD\FightContext;

class FightShould extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->dice = $this
            ->getMockBuilder('Sensorario\DnD\Dice\Dice')
            ->disableOriginalConstructor()
            ->getMock();

        $this->logger = $this
            ->getMockBuilder('Psr\Log\LoggerInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->p1 = [
            'name' => 'Monaco',
            'bab'  => 15,
            'ca'   => 30,
            'pf'   => 60,
        ];

        $this->p2 = [
            'name' => 'Mostro',
            'bab'  => 15,
            'ca'   => 30,
            'pf'   => 60,
        ];

        $this->context = new FightContext([
            'opponents' => [
                $this->p1,
                $this->p2,
            ],
            'turns' => 0,
        ]);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Oops! Too Many blank shot
     */
    public function testEndDueTooTooManyBlankShot()
    {
        $fight = new Fight(
            $this->dice,
            $this->context,
            $this->logger
        );

        $fight->run($this->p1, $this->p2);
    }

    public function testWithD20FightEndsForSure()
    {
        $this->dice->expects($this->any())
            ->method('d20')
            ->willReturn(20);

        $fight = new Fight(
            $this->dice,
            $this->context,
            $this->logger
        );

        $fight->run($this->p1, $this->p2);

        $this->assertSame(true, $fight->isFinished());
    }

    public function testPlayerCamesFromOpponentsCollection()
    {
        $this->dice->expects($this->any())
            ->method('d20')
            ->willReturn(20);

        $fight = new Fight(
            $this->dice,
            $this->context,
            $this->logger
        );

        $fight->run($this->p1, $this->p2);

        $this->assertEquals(
            json_encode([[
                'name' => 'Monaco',
                'bab'  => 15,
                'ca'   => 30,
                'pf'   => 4,
            ], [
                'name' => 'Mostro',
                'bab'  => 15,
                'ca'   => 30,
                'pf'   => 0,
            ]]),
            json_encode($fight->getSfidanti())
        );
    }

    public function testWinnerIs()
    {
        $this->dice->expects($this->any())
            ->method('d20')
            ->willReturn(20);

        $fight = new Fight(
            $this->dice,
            $this->context,
            $this->logger
        );

        $fight->run($this->p1, $this->p2);

        $this->assertEquals('Monaco', $fight->getWinner());
    }

    public function testProvideNumberOfTurns()
    {
        $this->dice->expects($this->any())
            ->method('d20')
            ->willReturn(20);

        $fight = new Fight(
            $this->dice,
            $this->context,
            $this->logger
        );

        $fight->run($this->p1, $this->p2);

        $this->assertEquals(29, $fight->numberOfTurns());
    }

    public function testProvideNumberOfBlackShot()
    {
        $this->dice->expects($this->any())
            ->method('d20')
            ->willReturn(20);

        $fight = new Fight(
            $this->dice,
            $this->context,
            $this->logger
        );

        $fight->run($this->p1, $this->p2);

        $this->assertEquals(0, $fight->numberOfBlackShot());
    }

}
