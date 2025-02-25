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
 
        //filter by job category
        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        //filter by job location
        if ($request->has('location')) {
            $query->where('location', $request->input('location'));
        }
 //filter by job title
        if ($request->has('title')) {
            $query->where('title', $request->input('title'));
        }

        //filter by salary range
        if ($request->has('salary_min')) {
            $query->where('salary', '>=', $request->input('salary_min'));
        }

        if ($request->has('salary_max')) {
            $query->where('salary', '<=', $request->input('salary_max'));
        }

        $Postings = $query->get();

        return response()->json($Postings);
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

        $Posting = JobPosting::create($request->all());

        return response()->json($Posting, 201); // Return created job posting with 201 status
    }

    /**
     * Display the specified listing with the applications.
     */
    public function show(JobPosting $Posting)
    {
        $Posting->load('applications'); // Load applications for the job
        return response()->json($Posting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $Posting)
    {
        $request->validate([
            'title' => 'required|max:255', // Fixed validation rule
            'description' => 'required',
            'company' => 'required',
            'location' => 'required',
            'salary' => 'required',
            'category' => 'required',
        ]);

        $Posting->update($request->all()); // Update the job posting

        return response()->json($Posting); // Return updated job posting
    }

    /**
     * Remove the specified job listing from storage.
     */
    public function destroy(JobPosting $Posting)
    {
        $Posting->delete(); // Delete the job posting

        return response()->json(null, 204); // Return no content response
    }
}
