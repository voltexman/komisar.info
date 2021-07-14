<?php

/* @var $devices array */
/* @var $os array */

use dosamigos\chartjs\ChartJs;
?>

<div class="row">
    <div class="col-sm-6">
<!--        <div class="clearfix"><b class="text-center">По устройствам</b></div>-->
        <?= ChartJs::widget([
            'type' => 'pie',
            'id' => 'devicesChart',
            'options' => [
                'height' => 200,
                'width' => 400,
            ],
            'data' => [
                'radius' => "90%",
                'labels' => ['ПК', 'Мобильные'],
                'datasets' => [
                    [
                        'data' => [$devices['desktops'], $devices['mobiles']],
                        'label' => '',
                        'backgroundColor' => [
                            '#ADC3FF',
                            '#FF9A9A'
                        ],
                        'borderColor' => [
                            '#fff',
                            '#fff'
                        ],
                        'borderWidth' => 5,
                        'hoverBorderColor' => ["#999", "#999"],
                    ]
                ]
            ],
            'clientOptions' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'fontSize' => 12,
                        'fontColor' => "#425062",
                    ]
                ],
                'tooltips' => [
                    'enabled' => true,
                    'intersect' => true
                ],
                'hover' => [
                    'mode' => true
                ],
                'maintainAspectRatio' => false,
            ]
        ]) ?>
    </div>
    <div class="col-sm-6">
        <?= ChartJs::widget([
            'type' => 'pie',
            'id' => 'osChart',
            'options' => [
                'height' => 200,
                'width' => 400,
            ],
            'data' => [
                'radius' => "90%",
                'labels' => ['Android', 'Windows', 'Linux', 'iOS'],
                'datasets' => [
                    [
                        'data' => [$os['Android'], $os['Windows'], $os['Linux'], $os['iOS']],
                        'label' => '',
                        'backgroundColor' => [
                            '#ADC3FF',
                            '#FF9A9A',
                            '#ADC3FF',
                            '#FF9A9A'
                        ],
                        'borderColor' => [
                            '#fff',
                            '#fff',
                            '#fff',
                            '#fff'
                        ],
                        'borderWidth' => 5,
                        'hoverBorderColor' => ["#999", "#999", "#999", "#999"],
                    ]
                ]
            ],
            'clientOptions' => [
                'legend' => [
                    'display' => false,
                    'position' => 'bottom',
                    'labels' => [
                        'fontSize' => 14,
                        'fontColor' => "#425062",
                    ]
                ],
                'tooltips' => [
                    'enabled' => true,
                    'intersect' => true
                ],
                'hover' => [
                    'mode' => true
                ],
                'maintainAspectRatio' => false,

            ]
        ]) ?>
    </div>
</div>

