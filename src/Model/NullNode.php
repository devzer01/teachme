<?php

class NullNode extends ZNode
{
    public function __construct($name, $rep)
    {
        $this->name = $name;
        $this->rep = $rep;
        $this->val = 0x0;
    }
}