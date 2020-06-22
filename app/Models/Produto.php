<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    protected $fillable = ['name','description','price','image'];

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter){
            if($filter){
                $query->where('name', 'like', "%{$filter}%" );
            }
        })->paginate();  

        return $results;
    }
}
