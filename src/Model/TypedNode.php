<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 7:41 น.
 */
class TypedNode
{
    protected $ideology = null;

    protected $rep = [];

    protected $type = 'ACTOR';

    public function __construct($ideology, $rep, $type)
    {
        $this->ideology = $ideology;
        $this->rep = $rep;
        $this->type = $type;
    }
}