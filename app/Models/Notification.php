<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Activite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'activite_id',
        'content',
    ];

    public function clients(){
        return $this->belongsToMany(Client::class);
    }

    public function activites()
    {
        return $this->belongsTo(Activite::class);
    }
}
