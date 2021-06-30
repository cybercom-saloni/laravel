<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
class ProductsExport implements FromCollection,withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return ['id','name','sku','price','discount','quantity','description','status','category_id','created_at','updated_at'];
    }
    public function collection()
    {
        return Product::all();
    }
}
