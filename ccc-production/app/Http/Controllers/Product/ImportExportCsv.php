<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
class ImportExportCsv extends Controller
{
    protected $header =[];
    protected $data=[];

    public function gridAction()
    {

       return view('csv.csv');
    }

    public function importCsvAction(Request $request)
    {
        try{
            // echo $extension = $request->file->getClientOriginalExtension();
            // die;
        //    echo $request->file->getRealPath();
        //    die;

        $fileName = $_FILES['file']['name'];
        $file = public_path('csvFile/'.$fileName);
       $fileHandler = fopen($file,'r');
       echo "<pre>";
    //    print_r($fileHandler);
        while($row = fgetcsv($fileHandler,1000,',','"','\\'))
        {
            if(!$this->header)
            {
                $this->header = $row;
            }
            else
            {
                $this->data[]=array_combine($this->header,$row);
            }

        }
        // print_r($this->data);
        // $this->saveCsvFile();
        foreach($this->data as $key => $value)
        {
            // $product->setProducts($value);
            // $product->SaveData($value);
            //  print_r($value);
             if($value['status']== 'enable')
                {
                    $value['status'] = 1;
                }
                else
                {
                    $value['status'] = 0;
                }
            //     print_r($value);
            // die;
           $sku =$value['sku'];
            $product = Product::where('sku',$sku)->first();

            if(!$product)
            {
                $product = new Product();

                // $product->setProducts($value);
                $product->setRawAttributes($value);
            }
            else{

                // $product->setProducts($value);
                $product->setRawAttributes($value);
            }
            // print_r($product);
            // $product->setRawAttributes($value);
            $product->save();
        }

        fclose($fileHandler);
        // return redirect('/product')->with('productImport', 'File imported successfully!!!');

       }catch(Exception $e)
       {
           echo $e->getMessage();
       }
    }

    public function saveCsvFile()
    {
        $id = [];
        foreach($this->data as $key => $value)
        {
            // $product->setProducts($value);
            // $product->SaveData($value);
            //  print_r($value);

           $sku =$value['sku'];
            $product = Product::where('sku',$sku)->first();
            if(!$product)
            {
                $product = new Product();
                $product->setProducts($value);
                $product->setRawAttributes($value);
                // print_r($product->setRawAttributes($value));
            }
            else{

                $product->setProducts($value);
                $product->setRawAttributes($value);
                // print_r($product->setRawAttributes($value));
            }
            // print_r($product->setRawAttributes($value));
            // $product->setRawAttributes($value);
            $product->save();
        }
        return redirect('/product')->with('productImport', 'File imported successfully!!!');
    }
    public function exportCsvAction()
    {

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=ccc.csv');
        // echo "<pre>";
        $allProducts = Product::all();
        $file = public_path('csvFile/productcsv1.csv');
        $fileHandler = fopen('php://output','w');
        foreach($allProducts as $key => $product)
        {
            if(!$this->header)
            {
                $this->header = array_keys($product->getAttributes());
                // print_r($this->header);
                fputcsv($fileHandler,$this->header);
                fputcsv($fileHandler,$product->getAttributes());

            }
            else{
                // print_r($product->getAttributes());
                fputcsv($fileHandler,$product->getAttributes());
            }
        }

                // print_r(get_class_methods($product));
        fclose($fileHandler);
    }
}

