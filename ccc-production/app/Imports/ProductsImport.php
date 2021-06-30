<?php

namespace App\Imports;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProductsImport implements ToModel,WithHeadingRow
{
    // use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // echo $row['status'];
        if($row['status']=='enable')
        {
             $row['status'] = 1;
        }
        else
        {
             $row['status'] = 0;
        }
        //  echo "<pre>";
        //  echo $row['status'];
        //  die;
        if($row['sku'])
        {
            $product = Product::where('sku',$row['sku'])->first();
            if(!$product)
            {
                $product = new Product;
            }
            $product->setRawAttributes($row);
            // print_r($product);
            // die;
            $product->save();
            return $product;
        }
    }
}
