<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exercise extends Model
{
    /** @use HasFactory<\Database\Factories\ExerciseFactory> */
    use HasFactory;

    protected $table = 'exercises';

    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'exercise_category_id',
        'name',
        'primary_muscles',
        'secondary_muscles',
        'mechanic',
        'level',
        'force',
        'equipment',
        'instructions',
    ];

    /**
     * Get the exercise category of this exercise
     */
    public function exercise_category(): BelongsTo
    {
        return $this->belongsTo(ExerciseCategory::class, 'exercise_category_id');
    }

}
