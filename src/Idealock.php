<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 8:50 น.
 */
class Idealock extends Db
{
    protected $words = null;

    protected $table = 'idealock';

    protected $fields = [];

    protected $template = null;

    protected $sense = null;

    public function __construct()
    {
        parent::__construct();
        parent::init();
    }

    pub
}