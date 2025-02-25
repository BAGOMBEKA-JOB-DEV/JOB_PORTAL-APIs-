<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{

    protected $fillable = [
        'job_id',
        'user_id',
        'cover_letter',
        'status',
    ];

    // A job application belongs to a user (the applicant)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A job application belongs to a job posting
    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class, 'job_id');
    }
}
