<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'pays';
    protected $fillable = array('id', 'pays', 'couleur', 'continent');


    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
