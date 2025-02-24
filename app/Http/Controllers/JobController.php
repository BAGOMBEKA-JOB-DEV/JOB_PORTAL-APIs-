<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListings;

class JobController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data(job listings)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required',
        ]);
     

        // Insert the data into the database
        JobListings::create($validatedData);

        // Return a response
        return response()->json(['message' => 'Job Created Successfully!'], 201);
    }


    public function index()
    {
        // Fetch all jobs
        $jobs = JobListings::all();

        // Return the data as a JSON response
        return response()->json($jobs);
    }

    //update job
    public function update(Request $request, $id)
    {
        $job = JobListings::findOrFail($id);
        $job->name = $request->name;
        $job->email = $request->email;
        $job->phone = $request->phone;
        $job->save();

        return response()->json(['message' => 'Job updated successfully!']);
    }

      // Delete job
      public function destroy($id)
      {
          $job = JobListings::findOrFail($id);
          $job->delete();
  
          return response()->json(['message' => 'Job deleted successfully!']);
      }

    

}
