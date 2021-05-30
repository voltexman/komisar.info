<?php

use dosamigos\chartjs\ChartJs;

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Статистика по устройствам</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <?= ChartJs::widget([
            'type' => 'pie',
            'id' => 'structurePie',
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
                        'borderWidth' => 1,
                        'hoverBorderColor' => ["#999", "#999"],
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

