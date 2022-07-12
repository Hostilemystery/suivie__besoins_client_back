<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Activite;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'utilisateur_id',
        'image',
        'Info_Service',
    ];

    public function activites()
    {
        return $this->hasMany(Activite::class);
    }

    public function client(){
        return $this->belongsToMany(Client::class);
    }

    public function utilisateurs()
    {
        return $this->belongsTo(User::class);
    }
}
