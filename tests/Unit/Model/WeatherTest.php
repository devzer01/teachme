<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 9:37 น.
 */

require_once __DIR__ . '/../../../src/Experiment/Weather.php';
require_once __DIR__ . '/../../../src/Experiment/WeatherPersonality.php';
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    public function testload()
    {
        $w = new WeatherPersonality();
        $r = $w->parse('hi there, how are you');

        $this->assertEquals([], $r);

    }
}
