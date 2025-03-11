<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PlanWorkoutExercise extends Model
{
    /** @use HasFactory<\Database\Factories\PlanWorkoutExerciseFactory> */
    use HasFactory;

    protected $table = 'plan_workout_exercises';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'plan_workout_id',
        'exercise_category_id',
        'exercise_id',
        'day_index',
        'day_order',
        'exercise_definition_json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function planWorkout(): BelongsTo
    {
        return $this->belongsTo(PlanWorkout::class);
    }

    public function exerciseCategory(): BelongsTo
    {
        return $this->belongsTo(ExerciseCategory::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

}
