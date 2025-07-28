<?php

namespace App\Models;

use App\Models\User;
use App\Models\Livry;
use Illuminate\Support\Str;
use App\Models\AceptLivraison;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
 
class Livreur extends Model
{

   
    use HasUuids;
    protected $fillable = [
        "user_id",
        "name",
        "prenom",
        "ville",
        "status",
        "phone",
       
    ];
    protected $keyType = 'string';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acceptLivraisons()
    {
        return $this->hasMany(AceptLivraison::class, 'livreur_id');
    }
    public function livraisons()
    {
        return $this->hasMany(Livry::class, 'user_id');
    }

      public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
