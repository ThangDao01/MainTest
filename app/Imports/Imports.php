<?php

namespace App\Imports;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Imports implements ToCollection
{
//    public function model(array $row)
//    {
//        return new Article([
//            'url'=>$row[0],
//            'thumbnail'=>$row[1],
//            'title'=>$row[2],
//            'category'=>$row[3],
//            'description'=>$row[4],
//            'detail'=>$row[5],
//            'source'=>$row[6],
//            'created_at'=>$row[7],
//            'updated_at'=>$row[8],
//        ]);
//    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
//            Article::create([
//                'url' => '$row[0]',
//                'thumbnail' => '$row[1]',
//                'title' => '$row[2]',
//                'category' => '$row[3]',
//                'description' => '$row[4]',
//                'detail' => '$row[5]',
//                'source' => '$row[6]',
//                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
//                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
//            ]);
            $obj = new Article();
            $obj->url = $row[0];
            $obj->thumbnail = $row[1];
            $obj->title = $row[2];
            $obj->category = $row[3];
            $obj->description = $row[4];
            $obj->detail = $row[5];
            $obj->source = $row[6];
            $obj->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $obj->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $obj->save();
        }
    }
}
