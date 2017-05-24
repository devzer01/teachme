<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 8:20 น.
 */
class Ideology
{
    protected $name = '';

    protected $value = '';

    protected $sls = []; //tree top

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function put($concept) {
        $this->sls[] = $concept;
    }
}