<?php

namespace Psalm\CodeceptionPlugin\Tests;

use SimpleXMLElement;
use Psalm\CodeceptionPlugin\Plugin;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psalm\Plugin\RegistrationInterface;

class PluginTest extends TestCase
{
    /**
     * @var ObjectProphecy
     */
    private $registration;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->registration = $this->prophesize(RegistrationInterface::class);
    }

    /**
     * @test
     * @return void
     */
    public function hasEntryPoint()
    {
        $this->expectNotToPerformAssertions();
        $plugin = new Plugin();
        $plugin($this->registration->reveal(), null);
    }

    /**
     * @test
     * @return void
     */
    public function acceptsConfig()
    {
        $this->expectNotToPerformAssertions();
        $plugin = new Plugin();
        $plugin($this->registration->reveal(), new SimpleXMLElement('<myConfig></myConfig>'));
    }
}
