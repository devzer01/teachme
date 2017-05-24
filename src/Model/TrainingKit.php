<?php

require_once 'TypedNode.php';
require_once 'NullNode.php';
require_once 'PeerNode.php';

class weatxxxxher {

    public function load() {

        $water = new PeerNode('rain', [], 0x100AA001);

        $rain = new PeerNode('rain', [], 0);
        $rain->contains($water);

        $_weather_ = new Ideology('weather', 0x000AA000);
        $_weather_->put($rain);
        $_weather_->put(new PeerNode('snow', [], 0));
        $_weather_->put(new PeerNode('wind', [], 0));

        $weather = new TypedNode($_weather_, [], 0x000AA000);
        $rain = new PeerNode('rain', [],0x111AA111);
        $water = new PeerNode('water', ['liquid', 'chemistry', 'rain', 'homoliquidness'],0x111AA111);

    }

}

$x = ['weather' => [
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
        ],
        'snow',
        'wind'
    ]
]];