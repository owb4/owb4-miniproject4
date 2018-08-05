<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Charts\DonutChart;
use App\Charts\BarChart;
use App\Question;
use App\Answer;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $questions = $user->questions()->paginate(6);

        //Donut Chart
        $donutChart = new DonutChart;
        // Add the dataset (we will go with the chart template approach)
        $questionCount = Question::all()->count();
        $answerCount = Answer::all()->count();
        $donutChart->dataset('Q/A', 'doughnut', [$questionCount, $answerCount])->backgroundcolor(['blue','red'])->color(['blue','red']);

        //Line Chart
        $barChart = new BarChart;
        // Add the dataset (we will go with the chart template approach)
        $userCount = User::all()->count();
        $barChart->dataset('Active Users', 'bar', [$userCount])->backgroundcolor(['green'])->color(['green']);

        return view('home')->with('questions', $questions)->with('donutChart', $donutChart)->with('barChart', $barChart);
    }
}
