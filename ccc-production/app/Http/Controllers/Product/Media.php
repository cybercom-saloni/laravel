<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Media as ProductMedia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Media extends Controller
{


    public function saveAction($id, Request $request)
    {
           try{

            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $targetFile=public_path("images/products/real/$id/").$request->image->getClientOriginalName();
            $uploadok =1;
            if(file_exists($targetFile))
            {
                 return \redirect('/product/media/' . $id)->with('error', 'file already exists!!!');
            }

            else
            {

                $imageName = $request->image->getClientOriginalName();
                $mediaData = [
                    'media' => $imageName,
                    'product_id' => $id
                ];
                $media = new ProductMedia;
                if ($media->saveData($mediaData)) {
                    $filename = $request->image;
                    $image = getimagesize($request->image);
                    $imageWidth = $image[0];
                    $imageHeight = $image[1];
                    $mime = $image['mime'];
                    $this->resizeImage($filename,$imageWidth,$imageHeight,$mime,100,100,$imageName);
                    $this->resizeImage($filename,$imageWidth,$imageHeight,$mime,200,200,$imageName);
                    $filename->move(public_path("images/products/real/$id"), $imageName);
                    return \redirect('/product/media/' . $id)->with('productUpload', 'product Media Uploaded successfully!!!');
                }
            }
           }
           catch (\Exception $e) {
                   echo  $e->getMessage();
            //     //    die;
            //         Session::put('producterror',$e->getMessage());
           }
    }
    public function productUpdateAction(Request $request)
    {
        if (array_key_exists('update', $_POST)) {

            $imageData = $request->get('image');

            if ($imageData) {

                $small = "";
                $thumb = "";
                $base = "";

                if (array_key_exists('small', $imageData)) {
                    $small = $imageData['small'];
                    unset($imageData['small']);
                }

                if (array_key_exists('thumb', $imageData)) {
                    $thumb = $imageData['thumb'];
                    unset($imageData['thumb']);
                }
                if (array_key_exists('base', $imageData)) {
                    $base = $imageData['base'];
                    unset($imageData['base']);
                }

                foreach ($imageData as $key => $value) {

                    if (array_key_exists('remove', $value)) {
                        unset($value['remove']);
                    }

                    if ($key == $small) {
                        $value['small'] = 1;
                    }

                    if ($key == $base) {
                        $value['base'] = 1;
                    }

                    if ($key == $thumb) {
                        $value['thumb'] = 1;
                    }



                    if (!array_key_exists('base', $value)) {
                        $value['base'] = 0;
                    }
                    if (!array_key_exists('small', $value)) {
                        $value['small'] = 0;
                    }
                    if (!array_key_exists('thumb', $value)) {
                        $value['thumb'] = 0;
                    }

                    if (!array_key_exists('gallery', $value)) {
                        $value['gallery'] = 0;
                    } else {
                        $value['gallery'] = 1;
                    }

                    //unset($value['imageType']);
                    print_r($value);

                    $values = array_values($value);
                    $fields = array_keys($value);
                    $final = array_combine($fields, $value);

                    $final['id'] = $key;

                    $mediaModel = new ProductMedia;

                    $mediaModel->updateData($final);
                }

            }
        }

        if (array_key_exists('delete', $_POST)) {

            $keys = [];

            $imageData = $request->image;
            if (array_key_exists('base', $imageData)) {
                unset($imageData['base']);
            }
            if (array_key_exists('small', $imageData)) {
                unset($imageData['small']);
            }
            if (array_key_exists('thumb', $imageData)) {
                unset($imageData['thumb']);
            }

            foreach ($imageData as $key => $value) {
                if (array_key_exists('remove', $value)) {
                    $keys[] = $key;
                }
            }

            if (!$keys) {
                throw new Exception("Please Select The Image", 1);
            }

            $Media = new ProductMedia;

            $query = "SELECT media,product_id from media  where id IN (" . implode(',', $keys) . ")";
            $filenames = $Media->fetchAll($query)->getMedias();

            foreach ($filenames as $key => $value) {
                unlink("images/products/real/{$value->product_id}/{$value->media}");
            }

            $Media->deleteData($keys);

        }

        return redirect()->back()->with('updateMedia','Media Edited SuccessFully');
    }

    function resizeImagetry($filename, $newwidth, $newheight)
    {
        list($width, $height) = getimagesize($filename);
        if($width > $height && $newheight < $height){
            $newheight = $height / ($width / $newwidth);
        } else if ($width < $height && $newwidth < $width) {
            $newwidth = $width / ($height / $newheight);
        } else {
            $newwidth = $width;
            $newheight = $height;
        }
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($filename);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        return imagejpeg($thumb);
    }



    // public function productUpdateAction($id, Request $request)
    // {
    //     $imageData = $request->image;
    //     // print_r($imageData);
    //     if($imageData)
    //     {
    //         $small = "";
    //         $thumb = "";
    //         $base = "";

    //         if (array_key_exists('small', $imageData)) {
    //             $small = $imageData['small'];
    //             unset($imageData['small']);
    //         }

    //         if (array_key_exists('thumb', $imageData)) {
    //             $thumb = $imageData['thumb'];
    //             unset($imageData['thumb']);
    //         }
    //         if (array_key_exists('base', $imageData)) {
    //             $base = $imageData['base'];
    //             unset($imageData['base']);
    //         }
    //         foreach ($imageData as $key => $value) {

    //             if (array_key_exists('remove', $value)) {
    //                 unset($value['remove']);
    //             }

    //             if ($key == $small) {
    //                 $value['small'] = 1;
    //             }

    //             if ($key == $base) {
    //                 $value['base'] = 1;
    //             }

    //             if ($key == $thumb) {
    //                 $value['thumb'] = 1;
    //             }


    //             if (!array_key_exists('base', $value)) {
    //                 $value['base'] = 0;
    //             }
    //             if (!array_key_exists('small', $value)) {
    //                 $value['small'] = 0;
    //             }
    //             if (!array_key_exists('thumb', $value)) {
    //                 $value['thumb'] = 0;
    //             }


    //             if (!array_key_exists('gallery', $value)) {
    //                 $value['gallery'] = 0;
    //             } else {
    //                 $value['gallery'] = 1;
    //             }

    //             print_r($value);

    //             $values = array_values($value);
    //             $fields = array_keys($value);

    //             $final = array_combine($fields,$values);

    //            $final['id']= $key;
    //            $mediaModel = new ProductMedia;
    //            $mediaModel->updateData($final);
    //         }
    //     }
    //     return \redirect('/product/media/' . $id)->with('updateMedia', 'Product Media Updated!!!');
    // }

    public function deleteAction($id,Request $request)
    {
        $imageData = $request->image;

            $keys = [];

            $imageData = $request->image;
                unset($imageData['base']);
                unset($imageData['small']);
                unset($imageData['thumb']);

            foreach ($imageData as $key => $value) {
                if (array_key_exists('remove', $value)) {
                    $keys[] = $key;
                }
            }
            $Media = new ProductMedia;

            $query = "SELECT media,product_id from media  where id IN (" . implode(',', $keys) . ")";
            $imageNames = $Media->fetchAll($query)->getMedias();

            foreach ($imageNames as $key => $value) {
                unlink("images/products/{$value->product_id}/{$value->media}");
            }

            $Media->deleteData($keys);

        return \redirect('/product/media/' . $id)->with('deleteMedia', 'Product Media Deleted!!!');
    }


}
