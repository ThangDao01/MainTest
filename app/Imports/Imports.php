<?php

namespace App\Imports;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class Imports implements ToCollection,WithHeadingRow
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
        Validator::make($rows->toArray(), [
            '*.url' => 'required',
            '*.thumbnail' => 'required',
            '*.title' => 'required',
            '*.category' => 'required',
            '*.description' => 'required',
            '*.detail' => 'required',
        ])->validate();
        foreach ($rows as $row) {
//            Article::create([
//                'url' => $row['url'],
//                'thumbnail' => $row['thumbnail'],
//                'title' => $row['title'],
//                'category' => $row['category'],
//                'description' => $row['description'],
//                'detail' => $row['detail'],
//                'source' => $row['source'],
//                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
//                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
//            ]);

            $obj = new Article();
            $obj->url = $row['url'];
            $obj->thumbnail = $row['thumbnail'];
            $obj->title = $row['title'];
            $obj->category = $row['category'];
            $obj->description = $row['description'];
            $obj->detail = $row['detail'];
            $obj->source = $row['source'];
            $obj->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $obj->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $obj->save();
        }
    }
}
