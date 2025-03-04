<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExerciseCategory extends Model
{
    /** @use HasFactory<\Database\Factories\ExerciseCategoryFactory> */
    use HasFactory;

    protected $table = 'exercise_categories';

    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'json_template',
        'description'
        // created_at
        // updated_at
    ];

    /**
     * Get the exercises for the blog exercise-category
     */
    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'exercise_category_id');
    }

}
