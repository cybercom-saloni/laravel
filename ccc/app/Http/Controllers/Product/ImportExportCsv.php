<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ImportExportCsv extends Controller
{
    protected $header =[];
    protected $data=[];
    public function importCsvAction(Request $request)
    {
       try{

        $fileName = $_FILES['file']['name'];
        if(!$fileName)
        {
            throw new Exception("File is not found");
            
        }
        $file = public_path('csvFile/'.$fileName);
       $fileHandler = fopen($file,'r');
       echo "<pre>";
    //    print_r($fileHandler);
        while($row = fgetcsv($fileHandler,1000,',','"','\\'))
        {
            if($this->header)
            {   
                $this->data[]=array_combine($this->header,$row);
            }
            else
            {
                $this->header = $row;
            }

            // print_r($row);
            // print_r($this->header);
            // print_r($this->data);
            $this->saveCsvFile();
        }
       }catch(Exception $e)
       {
           echo $e->getMessage();
       }
    }

    public function saveCsvFile()
    {
        $product = new Product();
        foreach($this->data as $key => $value)
        {

            // print_r($value);
            // foreach($value as $key1 => $value2)
            // {
            //     echo $value2;
            // }
            $product->setProducts($value);
            $product->saveData($value);
            
        }
    }

    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    public function getProducts()
    {
        if(!$this->products)
        {
            return new Product();
        }
        return $this->products;
    }


    // $product = $this->getProductModel();
    // $formData = $request->get('product');
    // // print_r($formData);
    // date_default_timezone_set('Asia/Kolkata');
    // if ($id) {
    //     $formData['id'] = $id;
    //     $formData['updated_at'] = date('Y-m-d h:i:s');
    // } else {
    //     $formData['created_at'] = date('Y-m-d h:i:s');
    // }
    
    // if ($product->saveData($formData)) {
    //     // Session::put('productSave', 'Product Saved successfully!!!');
    //             return redirect('/product')->with('productSaves', 'Product Saved successfully!!!');
    // }
    // }
}

