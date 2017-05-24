<?php

/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 2:55 น.
 */

require_once 'Ear.php';
require_once 'TypedNode.php';

class Listen extends Ear
{
    protected $values = [ 'state' => 1, 'act' => 2, 'matter' => 3, 'time' => 4 ];


    protected $context = [
        'conversation' => [
            'friendly' => 0x10011001,
            'flirting' => 0x10F11F01,
            'sex'      => 0x10FFFF01,
            'learning' => 0x10000001,
            'teaching' => 0x11000011
        ]
    ];

    //when feeling uncertain and hearing an unfamiliar noise makes me nervous

    /**
     * @var int/*'listener' => [
    'rep' => ['You', 'you'],
    'val' => 0x00000001,
    'typeof' => ['ACTOR','BEING'] //can put a checksum
    ],*/

    protected $pp = 0b0000000;

    //protected $sports = new TypedNode('sports', '[]', 'x', 'y');

    protected $friendly = [
        'listener' => [
            'rep' => ['You', 'you'],
            'val' => 0x00000001,
            'typeof' => ['ACTOR','BEING'] //can put a checksum
        ],
        'sender' => [
            'rep' => ['I', 'i', 'i am'],
            'val' => 0x10000000,
            'typeof' => ['ACTOR', 'SELF']
        ],
      //  'sports' => $sports,
        'weather' => [
            'rep' => [
                'rain' => [
                    'val' => 0x111AA111,
                    'concept' => [
                        'water' => [
                            'val' => 0x100AA001,
                            'concept' => [
                                'liquid',
                                'chemistry',
                                'rain',
                                'homoliquidness' => [
                                    'val' => 0,
                                    'concepts' => [
                                        'human' => [
                                            'val' => 0x93, //evolved //value of human is not defined, should be a group effort if needed to be defined
                                            'concepts' => [
                                                'being' => [
                                                    'val' => 0xFFFF ^ 0x6009,
                                                    'concepts' => [
                                                        'be' => ['val' => 0xFFFF,  'concepts' => null],
                                                        'ing' => ['val' => 0x6009, 'concepts' => null]
                                                    ],
                                                ]
                                            ],
                                        'body',
                                        'liquid',
                                        '99%',
                                        'hydration'
                                    ]
                                ]
                            ]
                        ],
                        'clouds',
                        'wet',
                        'thunder',
                        'lightning'
                    ]
                ],
                'snow',
                'wind'
            ],
            'val' => 0x000AA000
        ]
        ]
    ];

    protected $conversation = [
        'conversation' => [
            'friendly' => null
        ]
    ];

    //now we need to describe from the point of view
    //index 0 is receiver point of view, 1 is sender point of view
    protected $mapping = [
        'person' => [
            'listner' => [
                'rep' => ['i', 'am', 'myself', 'self', 'me?', 'me'],
                'val' => 0x01 ],
            'sender' => [
                'rep' => ['you', 'yours', 'yourself'],
                'val' => 0x0100
                ],
            'thyself' => [
                'rep' => ['them', 'they', 'those'],
                'val' => 0x010000
            ],
            'matter' => [
                'rep' => ['it', 'is', 'that', 'how', 'can'],
                'val' => 0x01000000
            ],
            'life' => [
                'rep' => ['animal', 'human', 'trees'],
                'val' => 0x0100000000
            ]
        ],
        'act' => [
            'actor' => [
                'rep' => ['going', 'make', 'help'],
                'val' => 0x02,
                ],
            'viewer' => [
                'rep' => ['you', 'yours', 'yourself'],
                'val' => 0x0200
            ],
            'time' => [
                'rep' => ['was', 'day', 'those', 'today'],
                'val' => 0x020000
            ],
            'natural' => [
                'rep' => ['windy', 'storm', 'snow', 'air'],
                'val' => 0x02000000
            ]],
        'observation' => [
            'natural' => [
                'rep' => ['windy', 'storm', 'snow'],
                'val' => 0x04,
                ],
            'result' => [
                'rep' => ['help', 'please', 'yourself'],
                'val' => 0x0400
            ],
            'reason' => [
                'rep' => ['them', 'they', 'those'],
                'val' => 0x040000
            ]
        ]
    ];

    //serialized view
    protected $response = [
        'mood' => [
            'sense' => [
                'recognition' => [
                    'concepts' => [
                        'recognized' => [
                            'yes' =>[
                                'feeling attached?' => [
                                    'yes',
                                    'no'],
                                'response'
                            ],
                            'no' => 'learn'
                        ]
                    ],
                    'prototypes' => [],
                ]
            ]
        ]
    ];

    protected $copath = [
        'symbol' => [
            'known' => 'retrieve related info',
            'unknown' => 'any familiar symbols' ]
    ];

    protected $learning = [
        'objective' => ['topics' => ['topic1', 'topic2'] ]
    ];

    /*'how to do'
    'how are you' => 'how'
    'how' => 'act of meassure' => 'act of inquiry'*/

    public function identify($word)
    {
        $perception = 0;

        $top = $this->topLevel();
        foreach ($top as $k => $v) {
            $subs = $this->secondLevel($v);
            foreach ($subs as $sub => $val) {
                try {
                    $perception += $this->__identify($word, $v, $val);
                } catch (Exception $e) {
                    println("entity not recognized");
                }
            }
        }
        return $perception;
    }

    public function topLevel()
    {
        return array_keys($this->mapping);
    }

    public function secondLevel($key)
    {
        return array_keys($this->mapping[$key]);
    }

    public function __identify($word, $type, $viewpoint)
    {
        if (!isset($this->mapping[$type]) || !isset($this->mapping[$type][$viewpoint])) {
            throw new Exception('type or $viewpoint ' . $word . ' set' . $type . ':::::' . $viewpoint);
        }

        $k = $this->mapping[$type][$viewpoint];
        if (in_array($word, $k['rep'])) {
            return $k['val'];
        }

        return 0;
    }

    public function value($word)
    {
        foreach ($this->mapping as $k => $v) {
            foreach ($v as $val => $words) {
                if (in_array($word, $words)) {
                    return $val;
                }
            }
        }
    }

    public function hear($message)
    {
        $perception = 0;
        $words = $this->parse($message);
        foreach ($words as $word) {
            //$perception += $this->value($word);
            $perception += $this->identify($word);
        }

        return $perception;
    }


}