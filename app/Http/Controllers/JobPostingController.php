<?php
namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;

class JobPostingController extends Controller
{
    /**
     * Display all the job listings
     */
    public function index(Request $request)
    {
        $query = JobPosting::query();

        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->has('salary_min')) {
            $query->where('salary', '>=', $request->input('salary_min'));
        }

        if ($request->has('salary_max')) {
            $query->where('salary', '<=', $request->input('salary_max'));
        }

        $jobPostings = $query->get();

        return response()->json($jobPostings);
    }

    /**
     * Store a newly created job listing in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255', // Fixed validation rule
            'description' => 'required',
            'company' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'category' => 'required',
        ]);

        $jobPosting = JobPosting::create($request->all());

        return response()->json($jobPosting, 201); // Return created job posting with 201 status
    }

    /**
     * Display the specified listing with the applications.
     */
    public function show(JobPosting $jobPosting)
    {
        $jobPosting->load('applications'); // Load applications for the job
        return response()->json($jobPosting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $jobPosting)
    {
        $request->validate([
            'title' => 'required|max:255', // Fixed validation rule
            'description' => 'required',
            'company' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'category' => 'required',
        ]);

        $jobPosting->update($request->all()); // Update the job posting

        return response()->json($jobPosting); // Return updated job posting
    }

    /**
     * Remove the specified job listing from storage.
     */
    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete(); // Delete the job posting

        return response()->json(null, 204); // Return no content response
    }
}
