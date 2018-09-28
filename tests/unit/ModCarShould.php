<?php

use Sensorario\DnD\ModCar;

class ModCarShould extends PHPUnit\Framework\TestCase
{
    public function testElaborateModifiers()
    {
        $this->ability = $this
            ->getMockBuilder('Sensorario\DnD\Ability')
            ->disableOriginalConstructor()
            ->getMock();

        $this->proficiency = $this
            ->getMockBuilder('Sensorario\DnD\Proficiency')
            ->disableOriginalConstructor()
            ->getMock();

        $mod = new ModCar(
            $this->ability,
            $this->proficiency
        );

        $this->assertSame(0, $mod->elaborate());
    }

    public function testRollAbilityAndProficiencyBonus()
    {
        $this->ability = $this
            ->getMockBuilder('Sensorario\DnD\Ability')
            ->disableOriginalConstructor()
            ->getMock();
        $this->ability->expects($this->once())
            ->method('use')
            ->willReturn(0);

        $this->proficiency = $this
            ->getMockBuilder('Sensorario\DnD\Proficiency')
            ->disableOriginalConstructor()
            ->getMock();
        $this->proficiency->expects($this->once())
            ->method('use')
            ->willReturn(0);

        $mod = new ModCar(
            $this->ability,
            $this->proficiency
        );

        $this->assertSame(0, $mod->elaborate());
    }

    public function testSumsAbilityAndProviciency()
    {
        $this->ability = $this
            ->getMockBuilder('Sensorario\DnD\Ability')
            ->disableOriginalConstructor()
            ->getMock();
        $this->ability->expects($this->once())
            ->method('use')
            ->willReturn(1);

        $this->proficiency = $this
            ->getMockBuilder('Sensorario\DnD\Proficiency')
            ->disableOriginalConstructor()
            ->getMock();
        $this->proficiency->expects($this->once())
            ->method('use')
            ->willReturn(5);

        $mod = new ModCar(
            $this->ability,
            $this->proficiency
        );

        $this->assertSame(6, $mod->elaborate());
    }
}
