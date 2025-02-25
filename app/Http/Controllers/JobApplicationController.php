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
        $Applications = JobApplication::all();
        return response()->json($Applications);
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

        $Application = JobApplication::create($request->all());

        return response()->json($Application, 201);
    }

    /**
     * Display a specific job application
     */
    public function show(JobApplication $Application)
    {
        return response()->json($Application);
    }

    /**
     * Update a specific job posting in storage.
     */
    public function update(Request $request, JobApplication $Application)
    {
        $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
            'user_id' => 'required|exists:users,id',
            'cover_letter' => 'required',
            'status' => 'required',
        ]);

        $Application->update($request->all());

        return response()->json($Application);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $Application)
    {
        $Application->delete();

        return response()->json(null, 204);
    }
}
