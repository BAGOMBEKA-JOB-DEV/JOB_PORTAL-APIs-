<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display all job applications
     */
    public function index()
    {
        $jobApplications = JobApplication::all();
        return response()->json($jobApplications);
    }

    /**
     * Store a newly created job application in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job_postings,id',
            'user_id' => 'required|exists:users,id',
            'cover_letter' => 'required'
        ]);

        $jobApplication = JobApplication::create($request->all());

        return response()->json($jobApplication, 201);
    }

    /**
     * Display a specific job application
     */
    public function show(JobApplication $jobApplication)
    {
        return response()->json($jobApplication);
    }

    /**
     * Update a specific job posting in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'user_id' => 'required|exists:users,id',
            'cover_letter' => 'required',
            'status' => 'required',
        ]);

        $jobApplication->update($request->all());

        return response()->json($jobApplication);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();

        return response()->json(null, 204);
    }
}
