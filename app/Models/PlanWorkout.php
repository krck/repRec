<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class PlanWorkout extends Model
{
    /** @use HasFactory<\Database\Factories\PlanWorkoutFactory> */
    use HasFactory;

    protected $table = 'plan_workouts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        // Filled by the user
        'name',
        'description',
        // Filled by the backend on creation
        'user_id',
        'is_shared',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan_workout_exercises(): HasMany
    {
        return $this->hasMany(PlanWorkoutExercise::class);
    }

}
