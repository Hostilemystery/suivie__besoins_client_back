<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type_utilisateur extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'role',
    ];

    public function utilisateurs()
    {
        return $this->hasMany(User::class);
    }
}
