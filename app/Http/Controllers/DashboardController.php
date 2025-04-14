<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Province;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        // Post Status Chart - Bar Chart
        $postStatusChart = new LaravelChart([
            'chart_title' => 'Posts by Status',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Post',
            'group_by_field' => 'status',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_period' => 'year', // show data for the current year
            'filter_days' => 365, // last 365 days
            'where_raw' => "status IN ('pending', 'in_progress', 'resolved')",
            'chart_color' =>
                '129,140,248',
        ]);

        // Posts by Province - Pie Chart
        $postsByProvinceChart = new LaravelChart([
            'chart_title' => 'Posts by Province',
            'report_type' => 'group_by_relationship',
            'relationship_name' => 'province',
            'model' => 'App\Models\Post',
            'group_by_field' => 'name', // The province name field
            'aggregate_function' => 'count',
            'aggregate_field' => 'id',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'year', // show data for the current year
            'filter_days' => 365, // last 365 days
        ]);

        // Recent posts data for stats
        $totalPosts = Post::count();
        $pendingPosts = Post::where('status', 'pending')->count();
        $inProgressPosts = Post::where('status', 'in_progress')->count();
        $resolvedPosts = Post::where('status', 'resolved')->count();
        $recentPosts = Post::with(['user', 'province'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'postStatusChart',
            'postsByProvinceChart',
            'totalPosts',
            'pendingPosts',
            'inProgressPosts',
            'resolvedPosts',
            'recentPosts'
        ));
    }
}
