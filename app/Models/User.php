<?php

namespace App\Models;






use App\Models\Livry;
use App\Models\Livreur;
 
use App\Models\Payment;
use App\Models\Publish;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role',
        'phone',
        'google_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $keyType = 'string';
    public $incrementing = false;
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',


        ];
    }


    public function publish()
    {
        return $this->hasMany(Publish::class);
    }

    
    public function paiements()
    {
        return $this->hasMany(Payment::class);
    }
    public function livreur()
    {
        return $this->hasOne(Livreur::class);
    }
    public function livry()
    {
        return $this->hasMany(Livry::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isBailleur()
    {
        return $this->role === 'bailleur';
    }
    public function isLocataire()
    {
        return $this->role === 'locataire';
    }
    public function isOwner()
    {
        return auth()->check() && $this->id === auth()->user()->id;
    }

    public function isBan()
    {
        return !is_null($this->banned_at);
    }


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
