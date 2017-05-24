<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 7:41 น.
 */
class PeerNode
{
    protected $name = 'listener';

    protected $rep = [];

    protected $val = 0x0;

    protected $relation = 0;

    public function __construct($name, $rep, $val)
    {
        $this->name = $name;
        $this->rep = $rep;
        $this->val = $val;
    }

    public function __call($key, $value)
    {
        $this->relation = $key;
    }
}