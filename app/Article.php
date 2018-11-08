<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = 'article';
    protected $fillable = array('pays_id', 'code', 'designation','id');


    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}
