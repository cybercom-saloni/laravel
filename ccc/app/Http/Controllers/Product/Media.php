<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Media as ProductMedia;
use Exception;
use Illuminate\Http\Request;

class Media extends Controller
{
    public function saveAction($id, Request $request)
    {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time() . '.' . $request->image->extension();

            $mediaData = [
                'media' => $imageName,
                'product_id' => $id
            ];

            $media = new ProductMedia;
            if ($media->saveData($mediaData)) {
                $request->image->move(public_path("images/products/$id"), $imageName);
            }
        return \redirect('/product/media/' . $id)->with('message', 'success');
    }
    
    // public function updateAction($id, Request $request)
    // {
    //     if (array_key_exists('update', $_POST)) {
    //      $imageData = $request->get('image');
    //     // $imageData = $request->get('image');
    //     print_r($imageData);
    //     if ($imageData) {
    //         echo 123;
    //     }else
    //     {
    //         echo 'not';
    //     }
    // }else
    // {
    //     'helo';
    // }
    // }
        //     $small = "";
        //     $thumb = "";
        //     $base = "";

        //     if (array_key_exists('small', $imageData)) {
        //         $small = $imageData['small'];
        //         unset($imageData['small']);
        //     }

        //     if (array_key_exists('thumb', $imageData)) {
        //         $thumb = $imageData['thumb'];
        //         unset($imageData['thumb']);
        //     }
        //     if (array_key_exists('base', $imageData)) {
        //         $base = $imageData['base'];
        //         unset($imageData['base']);
        //     }

        //     foreach ($imageData as $key => $value) {

        //         if (array_key_exists('remove', $value)) {
        //             unset($value['remove']);
        //         }

        //         if ($key == $small) {
        //             $value['small'] = 1;
        //         }

        //         if ($key == $base) {
        //             $value['base'] = 1;
        //         }

        //         if ($key == $thumb) {
        //             $value['thumb'] = 1;
        //         }



        //         if (!array_key_exists('base', $value)) {
        //             $value['base'] = 0;
        //         }
        //         if (!array_key_exists('small', $value)) {
        //             $value['small'] = 0;
        //         }
        //         if (!array_key_exists('thumb', $value)) {
        //             $value['thumb'] = 0;
        //         }

        //         if (!array_key_exists('gallery', $value)) {
        //             $value['gallery'] = 0;
        //         } else {
        //             $value['gallery'] = 1;
        //         }
        //         $values = array_values($value);
        //         $fields = array_keys($value);
        //         $final = array_combine($fields, $value);
        //         $final['id'] = $key;
        //         $mediaModel = new ProductMedia;
        //         $mediaModel->updateData($final);
        //     }
        // }

        // return redirect('media/update/' . $id);
    

    public function updateAction(Request $request)
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
                unlink("images/products/{$value->product_id}/{$value->media}");
            }

            $Media->deleteData($keys);
        }

        return redirect()->back();
    }


    // public function deleteAction($id,Request $request)
    // {
    //     $imageData = $request->get('image');

    //         $keys = [];

    //         $imageData = $request->image;
    //             unset($imageData['base']);
    //             unset($imageData['small']);
    //             unset($imageData['thumb']);

    //         foreach ($imageData as $key => $value) {
    //             if (array_key_exists('remove', $value)) {
    //                 $keys[] = $key;
    //             }
    //         }
    //         $Media = new ProductMedia;

    //         $query = "SELECT media,product_id from media  where id IN (" . implode(',', $keys) . ")";
    //         $imageNames = $Media->fetchAll($query)->getMedias();

    //         foreach ($imageNames as $key => $value) {
    //             unlink("images/products/{$value->product_id}/{$value->media}");
    //         }

    //         $Media->deleteData($keys);

    //     return \redirect('/product/media/' . $id);
    // }
}