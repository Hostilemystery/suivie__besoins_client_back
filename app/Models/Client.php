<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'number',
        'neighborhood',
        'email',
        'detaille_service',
        'service_id',
    ];

    public function notifications(){
        return $this->belongsToMany(Notification::class);
    }

    public function service()
    {
        return $this->belongsToMany(Service::class);
    }

}
