<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    protected $table = 'user_roles';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'role_id',
        'created_at',
        'updated_at'
    ];

}
