<?php

namespace App\Http\Controllers;
use App\Models\Routes as RouteModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Routes extends Controller
{
   public function gridAction()
   {
        $routes = RouteModel::all();
        $view = \view('routes.grid',['controller' => $this,'routes' => $routes])->render();
        $response=[
            'element'=>
            [
                'selector'=>'#content',
                'html'=>$view
            ]
        ];
        header('content-type:application/json');
        echo json_encode($response);
       die();
   }
}
