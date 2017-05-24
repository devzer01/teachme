<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 3:06 น.
 */

require_once __DIR__ . '/../../src/Model/Listen.php';

use PHPUnit\Framework\TestCase;

class ListenTest extends TestCase
{
    public function setUp()
    {

    }

    public function testHear()
    {
        $listen = new Listen();
        $p = $listen->hear("i going make it");
        $this->assertEquals(16777221, $p);
        $p = $listen->hear("how was your day");
        $this->assertEquals(17039360, $p);
        $p = $listen->hear("is it windy today");
        $this->assertEquals(67239940, $p);
        $p = $listen->hear("can you please help me");
        $this->assertEquals(16780035, $p);
    }

    public function testIdentify()
    {
        $listen = new Listen();
        $this->assertEquals(['storm', 'is', 'coming'], $listen->parse('storm is coming'));
        $this->assertEquals(50331652, $listen->hear('storm is coming'));
    }

    public function testlevels()
    {
        $listen = new Listen();
        $this->assertEquals(['person', 'act', 'observation'], $listen->topLevel());
        $this->assertEquals(['listner', 'sender', 'thyself',
            'matter', 'life'], $listen->secondLevel('person'));
    }

    public function testKnowladge()
    {
        $listen = new Listen();
        $p = $listen->hear("is it windy today");
        $this->assertEquals(67239940,  $p );
    }
}
