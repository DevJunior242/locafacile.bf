<?php

namespace App\Models;



use App\Models\User;
use App\Models\Livry;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Publish extends Model
{
    use HasUuids;
    protected $fillable = [
        'user_id',
        'replicate_id',
        "titre",
        "ville",
        "quartier",
        "type_cour",
        "type_sol",
        "form_logement",
        'etage',
        "prix",
        "caution",
        "avance",
        'nombre_chambres',
        'nombre_salons',
        'localisation',
        'description',
        'file',
        'path',
        'eau',
        'plafonnée',
        'courant',
        'douche',
        'climatisation',
        'garage_parking',
        'jardin',
        'ventilateur',
        'balcon',
        'terrasse',
        'cuisine',
        'internet',
        'meublée',
        'chateau_eau',
        'securite',
        'status'

    ];
    protected $keyType = 'string';
    public $incrementing = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function replications()
    {
        return $this->hasMany(Publish::class, 'replicate_id');
    }
    public function original()
    {
        return $this->belongsTo(Publish::class, 'replicate_id');
    }

    public function canRepublier()
    {
        if (!is_null($this->replicate_id)) {
            return false;
        }
        if ($this->status !== 'occupee') {
            return false;
        }
        $canReplicate = $this->replications()
            ->where('user_id', Auth::id())

            ->whereIn('status', ['disponible', 'archive', 'in_progress', 'attente_de_verification'])
            ->exists();
        return !$canReplicate;
    }

    public function livries()
    {
        return $this->hasMany(Livry::class);
    }

    public function isDisponible()
    {
        return $this->status === 'disponible';
    }
    public function isVerified()
    {
        return $this->status === 'attente_de_verification';
    }
    public function isBusy()
    {
        return $this->status === 'occupee';
    }
    public function inProgress()
    {
        return $this->status === 'in_progress';
    }

    public function montantTotal()
    {
        $prix = $this->prix;
        return ($prix * ($this->avance + $this->caution + 0.5));
    }
    public function getSum()
    {
        $prix = $this->prix;
        return ($prix * ($this->avance + $this->caution + 1));
    }
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string)Str::uuid();
        });
    }
}
