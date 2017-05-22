<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 20/5/2560
 * Time: 6:07 น.
 */

require_once 'db.php';

class Template extends Db {

    private $payload = null;

    private $words = null;

    protected $table = 'template';

    protected $fields = [];

    public function __construct()
    {
        parent::__construct();
        parent::init();
    }
}