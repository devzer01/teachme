<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 7:53 น.
 */
class ZNode
{
    protected $name = 'listener';

    protected $rep = [];

    protected $val = null;

    public function __construct($name, $rep, $val)
    {
        $this->name = $name;
        $this->rep = $rep;
        $this->val = $val;
    }
}