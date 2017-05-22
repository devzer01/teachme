<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 22/5/2560
 * Time: 20:18 น.
 */

require_once __DIR__ . '/../../src/db.php';
require_once __DIR__ . '/../../src/Concept.php';
require_once __DIR__ . '/../../src/Host.php';

use PHPUnit\Framework\TestCase;

class HostTest extends TestCase
{

    protected $host = null;

    public function setUp() {
        $this->host = new Host();
    }

    public function testMeaning() {
        $host = new Host();
        $result = $host->meaning('protection');
        $this->assertEquals(['concept_id' => '38', 'concept_name' => 'protection',
            'parent_id' => '0', 'template_id' => '19', 'template' => 'kiriya', 'receive_template_id' => 25,
            'give_template_id' => 0, 'observe_template_id' => 0], $result);
    }

    public function testwm() {
        $host = new Host();
        $result = $host->wm('hi');
        $this->assertEquals(1, count($result));
        $this->assertEquals(['id', 'word', 'concept_id'], array_keys($result[0]));
    }


    public function testparse() {
        $words = $this->host->parse("i am going to make it");
        $this->assertEquals(4, count($words));
        $concepts = $this->host->cognition($words);
        $this->assertEquals(['i', 'going', 'make', 'it'],array_keys($concepts));

/*        $dimensions = $this->host->conceptualize($concepts);
        $understanding = $this->host->understanding($words, $concepts, $dimensions);
        $this->assertEquals([[50,50,50], [50,50,50]], $understanding);*/

    }





}
