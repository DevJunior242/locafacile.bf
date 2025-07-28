<?php

namespace App\Models;

use App\Models\Livry;
use App\Models\Livreur;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AceptLivraison extends Model
{

     use HasUuids;
    protected $fillable = ['livrie_id','livreur_id', 'status'];
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'acept_livraisons';
 
    
    public function livrie()
    {
        return $this->belongsTo(Livry::class, 'livrie_id');
    }
    public function livreur()
    {
        return $this->belongsTo(Livreur::class, 'livreur_id');
    }

      public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
