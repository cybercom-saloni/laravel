<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    use HasFactory, Notifiable;
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
public $fillable =[
    'firstname',
    'lastname',
    'email',
   'password',
];

protected $hidden = [
    'password'
];

}
