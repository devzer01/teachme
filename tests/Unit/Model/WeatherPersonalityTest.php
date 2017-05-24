<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 10:24 น.
 */
class WeatherPersonalityTest
{
    public function testInquiry()
    {
        $wpt = new WeatherPersonality();
        $wpt->hear("Hello, how are you?");
    }
}