<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 9:07 น.
 */
class Weather
{

    //[1,2,3,4,5,6];

    protected $pov = [];

    protected $index = [];

    protected $tindex = [];

    public function find($topic, $tree)
    {
        if (in_array($topic, array_keys($tree['concept']))) {
            return $tree['concept'][$topic];
        }
        $this->find($topic, $tree['concept']);
    }

    public function dump($key = '')
    {
        return $this->index[$key];
    }

    public function bootup() {
        $pov = $this->relativize($this->load());
        $tree = $this->load();
        foreach($pov as $pv) {
            try {
                $this->tindex = [];
                $this->index[$pv] = $this->indexing($tree[$pv], []);
                //$this->index[$pv] = $this->tindex;
                $keys = array_keys($this->index[$pv]);
                $this->revdex = array_combine($keys, array_fill(0, count($keys), $pv));
            } catch (Exception $e) {

            }
        }
    }

    public function reverseLookup($word)
    {
        print_r($this->index);
        return isset($this->revdex[$word]);
    }

    public function know($word)
    {
        //search flat index by word
        //then pull in tree for knowledge expansion
       /* if (isset($this->revdex[$word])) {

        }

        if ($this->revdex[$word] && $this->index[$this->revdex[$word]]) {
            return $this->index[$this->revdex[$word]];
        }*/
       return [];
    }

    public function relativize($root)
    {
        return array_keys($root);
    }

    public function flatten($tree)
    {
        $idx = [];
        if (isset($tree['concept'])) {
            $keys = array_keys($tree['concept']);
            foreach($keys as $key) {
                if (!is_null($tree['concept'][$key])) {
                    $idx[$key] = $this->flatten($tree);
                } else {
                    $idx[$key] = $tree['concept'][$key];
                }
            }
        }

        return $idx;
    }

    public function indexing($tree, $acl)
    {
        if (!isset($tree['concept'])) {
            throw new Exception('incorrect root ');
        }
        foreach ($tree['concept'] as $c => $v) {
            if (is_array($v)) {
                $acl[$c] = $v;
            } else {
                $acl[$v] = 0x00;
            }
            if ($v !== null && isset($v['concept']) && count($v['concept']) > 0) {
                $acl = array_merge($this->indexing($v, $acl), $acl);
            }
        }

        return $acl;

    }

    public function knowladge()
    {
        return [
            'listener' => [
                0x00000001 => ['you'],
                'typeof' => ['ACTOR','BEING'] //can put a checksum
            ],
            'sender' => [
                0x10000000 => ['i', 'am'],
                'typeof' => ['ACTOR', 'SELF']
            ],
            'expressive' => [
                0xE000000B => ['hello' => 0x11001100,
                               'hi'    => 0x11001100,
                               'bonjor'=> 0xF1001100],
                'typeof' => ['GIVING']
            ],
            ['weather' => [
                'id' => 0x000AA000,
                'in' =>
            ]
            ]
                [
                    0x000AA000,
                    'rain' => [
                        0x111AA111 => [
                            'water' => [ 0x00 =
                    'water' => [
                                    0x100AA001 => [
                                    'liquid' => 0x100AAF01,
                                    'chemistry' => 0x100AAF02,
                                    'homoliquidness' => [0x100AAF03 =>
                                        [
                                            'human' => [0x93 => [ 'being' => [ 0x6009 => [ 'be' => 0xFFFF, 'ing' => 0x6009 ] ] ] ],
                                            'body' => null,
                                            'liquid' => null,
                                            '99%' => null,
                                            'hydration' => null,
                                            ]
                                        ]
                                    ],
                                    'clouds' => null,
                                    'wet' => null,
                                    'thunder' => null,
                                    'lightning' => null
                                ],
                    'snow' => null,
                    'wind' => null,
                    'typeof' => ['SUBJECT', 'MATTER']
                ]
        ];
    }

    public function load()
    {
        return  $this->knowladge();
    }
}