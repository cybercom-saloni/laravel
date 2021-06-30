<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Customer extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = 'customers';
    public $sortable =['id',
    'firstname',
    'lastname',
    'email',
    'contactNumber',
    'address',
    'area',
    'city',
    'state',
    'zipcode',
    'country'
];
}
