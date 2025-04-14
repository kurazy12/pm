<?php

namespace App\Exports;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PostExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $posts;

    public function __construct($posts)
    {
        // If we received a paginator, get the underlying collection
        if (method_exists($posts, 'getCollection')) {
            $this->posts = $posts->getCollection();
        } else {
            $this->posts = $posts;
        }
    }

    public function view(): View
    {
        return view('exports.posts', [
            'posts' => $this->posts
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text with background
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }
}
