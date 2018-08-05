<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class DonutChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->labels(['Questions', 'Answers'])
        ->options([
            'legend' => [
            'display' => true
            ],

            'gridLines' => [
                'display' => false
            ]
        ])->displayAxes(false);
    }
}

