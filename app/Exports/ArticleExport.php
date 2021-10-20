<?php

namespace App\Exports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArticleExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
        return Article::select(['url', 'thumbnail', 'title', 'category', 'description', 'detail', 'source'])->get();
    }

    public function headings(): array
    {
        return [
            'url', 'thumbnail', 'title', 'category', 'description', 'detail', 'source'
        ];
    }
}




