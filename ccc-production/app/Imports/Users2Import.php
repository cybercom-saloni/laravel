<?php

namespace App\Imports;

use App\Users2;
use Maatwebsite\Excel\Concerns\ToModel;

class Users2Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Users2([
            //
        ]);
    }
}
