<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_subjects')
            ->withPivot('grade')
            ->withTimestamps();
    }
}
