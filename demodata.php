<?php
/**
 * Created by mac.
 * User: mac
 * Date: 2018/11/8
 * Time: 下午9:52
 */

demo_data();
function demo_data(){
    $data1 = [
        'name'=>'flare',
        'children'=>[
            [ 'name'=>'analytics',
                'children'=>[
                    [ 'name'=>'analytics',
                        'children'=>[
                            [ 'name'=>'analytics',
                                'children'=>[
                                    [ 'name'=>'analytics',
                                        'children'=>[
                                            ['name'=>'Agglom',
                                                'value'=> 3938],
                                            ['name'=>'Communi',
                                                'value'=> 3812],
                                            ['name'=>'Hierar',
                                                'value'=> 6714],
                                            ['name'=>'Mergee',
                                                'value'=> 743],
                                        ],
                                    ],
                                    [ 'name'=>'graph',
                                        'children'=>[
                                            ['name'=>'Agglo',
                                                'value'=> 3938],
                                            ['name'=>'Commure',
                                                'value'=> 3812],
                                            ['name'=>'Hierr',
                                                'value'=> 6714],
                                            ['name'=>'Mere',
                                                'value'=> 743],
                                        ],
                                    ],

                                ],
                            ],
                            [ 'name'=>'graph',
                                'children'=>[
                                    ['name'=>'Agglo',
                                        'value'=> 3938],
                                    ['name'=>'Commure',
                                        'value'=> 3812],
                                    ['name'=>'Hierr',
                                        'value'=> 6714],
                                    ['name'=>'Mere',
                                        'value'=> 743],
                                ],
                            ],

                        ],
                    ],
                    [ 'name'=>'graph',
                        'children'=>[
                            ['name'=>'Agglo',
                                'value'=> 3938],
                            ['name'=>'Commure',
                                'value'=> 3812],
                            ['name'=>'Hierr',
                                'value'=> 6714],
                            ['name'=>'Mere',
                                'value'=> 743],
                        ],
                    ],

                ],
            ],
            [ 'name'=>'graph',
                'children'=>[
                    ['name'=>'Agglo',
                        'value'=> 3938],
                    ['name'=>'Commure',
                        'value'=> 3812],
                    ['name'=>'Hierr',
                        'value'=> 6714],
                    ['name'=>'Mere',
                        'value'=> 743],
                ],
            ],

        ]
    ];

    $data2 = [
        'name'=>'flare',
        'children'=>[
            [ 'name'=>'analytics',
                'children'=>[
                    ['name'=>'AgglomerativeCluster',
                        'value'=> 3938],
                    ['name'=>'CommunityStructure',
                        'value'=> 3812],
                    ['name'=>'HierarchicalCluster',
                        'value'=> 6714],
                    ['name'=>'MergeEdge',
                        'value'=> 743],
                ],
            ],
            [ 'name'=>'graph',
                'children'=>[
                    ['name'=>'AgglomerativeCluster',
                        'value'=> 3938],
                    ['name'=>'CommunityStructure',
                        'value'=> 3812],
                    ['name'=>'HierarchicalCluster',
                        'value'=> 6714],
                    ['name'=>'MergeEdge',
                        'value'=> 743],
                ],
            ],

        ]
    ];
    $data = [$data1,$data2];
    echo json_encode($data);
}