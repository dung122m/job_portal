<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'job_type_id',
        'vacancy',
        'salary',
        'location',
        'description',
        'benefits',
        'responsibility',
        'qualifications',
        'experience',
        'keywords',
        'company_name',
        'company_location',
        'website',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với JobType
    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ với JobApplication
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }

}
