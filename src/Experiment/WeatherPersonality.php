<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 10:21 น.
 */

require_once __DIR__ . '/../Model/Listen.php';
require_once __DIR__ . '/../Experiment/Weather.php';

class WeatherPersonality extends Listen
{

    protected $weather = null;

    public function __construct()
    {
        $this->weather = new Weather();
        //$this->indexing = $this->weather->knowladge();
    }

    public function hear($message)
    {
        $perception = 0;
        $words = $this->parse($message);
        foreach ($words as $word) {
            $perception += $this->weather->know($word);
        }

        return $perception;
    }
}