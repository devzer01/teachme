<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 20/5/2560
 * Time: 13:29 น.
 */

require_once __DIR__ . '/../../src/db.php';
require_once __DIR__ . '/../../src/Concept.php';
require_once __DIR__ . '/../../src/Host.php';

        $host = new Host();
        if ($host->recognize()) {
            print_r($host->concepts);
        } else if ($host->understand()) {
            $host->perception = $host->understanding;
        }
        $host->incoming(['message' => 'i am in love']);
        if ($host->think()) {
            if ($host->opinion()) { //basis for opinion here
                $reply['msg'] = $host->give()['phrase'];
            } else if($host->heardof()) { //existing idea or opinion expansion
                $reply['msg'] = "i have heard of it, but i do not know about it. Care to tell me about it?"; //based on the tree
            } else {
                if ($host->curious()) {
                    $reply['msg'] = "i don't know about it, let me quickly learn about it, give me 5 seconds.";
                } else {
                    $reply['msg'] = "i don't know about it, can you tell me more?";
                }
            }
}

if ($reply['msg'] === null) $reply['msg'] = "i am too busy to think today, maybe you can tell me another time";
        print_r($reply);
        /*$vision = $host->cognition();
        $education = $host->research();

        print_r($vision);
        print_r($education);

        $this->assertTrue(count($vision) > 0);
        $this->assertTrue(count($education) > 0);


        //$this->host->think();
        if ($this->host->opinion()) {

        }*/

    /*public function testEntry() {
        $concept = new Concept();
        $concept->entry(

        );
        $this->assertEquals(true, count($concept->all()) > 0 );
    }*/
