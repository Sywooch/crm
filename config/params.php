<?php

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'mail@antkaz.ru',
    // params for yii\grid\GridView
    'GridView' => [
        'summary' => '',
        'tableOptions' => [
            'class' => 'table table-striped table-condensed table-hover',
        ],
    ],
    // params for yii\bootstrap\ActiveForm
    'ActiveForm' => [
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n<small>{hint}\n{error}</small>\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ],
        ],
    ],
    'html' => [
        'control-label' => [
            'class' => 'control-label col-xs-4',
        ],
        'form-control-static' => [
            'class' => 'form-control-static col-xs-8',
        ]
    ]
];
