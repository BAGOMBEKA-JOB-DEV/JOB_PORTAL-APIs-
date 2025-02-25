<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobApplication;

class JobPosting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'company',
        'location',
        'salary',
        'category',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A job posting has many applications
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
