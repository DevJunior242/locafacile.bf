<?php

namespace App\Models;

use App\Models\User;
use App\Models\Publish;
use Illuminate\Support\Str;
use App\Models\AceptLivraison;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Livry extends Model
{

    use HasUuids;
    protected $fillable = [
        "user_id",
        "publish_id",
        "quartier",
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
        return $this->hasOne(AceptLivraison::class, 'livrie_id');
    }


    public function publish()
    {
        return $this->belongsTo(Publish::class);
    }
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d-m-Y à H:i');
    }

    public function isauthorized()
    {
        return $this->user_id === (auth()->user()->id ?? null);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
