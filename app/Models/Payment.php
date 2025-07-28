<?php

namespace App\Models;

use App\Models\User;
use App\Models\Publish;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Payment extends Model
{

    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

   protected $table='payments';
    protected $fillable = [
        "user_id",
        "publish_id",
        "call_app_id",
        "amount",
        "payment_status",
        "customer_name",
        "customer_email",
        "customer_phone",
        "receipt_url"
    ];
    public function publish()
    {
        return $this->belongsTo(Publish::class);
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
