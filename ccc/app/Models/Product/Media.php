<?php

namespace App\Models\Product;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Media extends Model
{
    use HasFactory;

    protected $medias = [];

    public function __construct()
    {
        $this->setTable('media');
    }

    public function getMedias()
    {
        return $this->medias;
    }

    public function fetchAll($query = null)
    {
        if (!$query) {
            $this->products = DB::table($this->getTable());
            return $this;
        }

        $this->medias = DB::select($query);
        return $this;
    }

    public function load($id)
    {
        $this->products = DB::select("select * from {$this->table} where {$this->primaryKey} = ?", [$id]);
        return $this;
    }

    public function saveData($data)
    {
        try {
            if (array_key_exists('id', $data)) {
                return $this->updateData($data);
            } else {
                \print_r($data);
                return $this->insert($data);
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function insert($data)
    {
        $insertedId = DB::table($this->table)->insertGetId($data);
        return ($insertedId) ? $insertedId : false;
    }

    public function updateData($data)
    {
        $update = DB::table($this->table)->where($this->primaryKey, $data[$this->primaryKey])->update($data);
        return ($update) ? true : false;
    }

    public function deleteData(array $id)
    {
        $delete = DB::table($this->table)->whereIn($this->primaryKey, $id)->delete();
        return ($delete) ? true : false;
    }
}
