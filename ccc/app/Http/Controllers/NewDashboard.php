<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewDashboard extends Controller
{
   public function dashboardAction()
   {
       $view = \view('newdashboard.grid');
       $response = 
       [
          'element' => [
             [
               'selector' => '#content',
               'html' => $view
             ]
          ]
      ];
      header('content-type:application/json');
      echo json_encode($response);

   }
}
