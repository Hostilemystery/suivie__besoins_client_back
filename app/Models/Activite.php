<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activite extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'service_id',
        'activity_Name',
        'starting_date',
        'end_date',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
