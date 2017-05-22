<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 3:06 น.
 */

require_once __DIR__ . '/../../src/Listen.php';

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
        $this->assertEquals(['state', 'act', 'observation'], $listen->topLevel());
        $this->assertEquals(['myself', 'theself', 'thyself',
            'matter', 'life'], $listen->secondLevel('state'));
    }

    public function testKnowladge()
    {
        $listen = new Listen();
        $p = $listen->hear("is it windy today");
        $this->assertEquals(0x01000000 | 0x01000000 | 0x02000000 | 0x020000,  $p );
    }
}
