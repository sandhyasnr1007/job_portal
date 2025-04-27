<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories and job types
    {
        $categories = Category::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();


        $jobs = Job::where('status', 1);

        //Search using keyword
        if (!empty($request->keyword)) {

            $jobs = $jobs->where(function ($query) use ($request) {
                $query->orwhere('title', 'like', '%'.$request->keyword.'%');
            });
        }
        $jobs = Job::where('status', 1)->with('jobType')->orderBy('created_at', 'DESC')->paginate(9);
        

        return view('front.jobs',[
            'categories' => $categories,
            'jobTypes'=> $jobTypes,
            'jobs'=> $jobs


        ]);
    }
}

}

// <form action="" name="serachForm" id="serachForm" method="">
//                     <div class="mb-4">
//                         <h2>Keywords</h2>
//                         <input type="text" name ="keyword" id="keyword" placeholder="Keywords" class="form-control">
//                     </div>

//                     <div class="mb-4">
//                         <h2>Location</h2>
//                         <input type="text" name ="location" id="location" placeholder="Location" class="form-control">
//                     </div>

//                     <div class="mb-4">
//                         <h2>Category</h2>
//                         <select name="category" id="category" class="form-control">
//                             <option value="">Select a Category</option>
//                             @if ($categories)
//                             @foreach ($categories as $category)

//                             <option value="{{ $category->id }}">{{ $category->name }}</option>

//                             @endforeach
                        
//                             @endif
//                         </select>
//                     </div>                   

//                     <div class="mb-4">
//                         <h2>Job Type</h2>

//                         @if ($jobTypes->isNotEmpty())
//                        @foreach ($jobTypes as $jobType)

//                        <div class="form-check mb-2"> 
//                            <input class="form-check-input " name="job_type" type="checkbox" value="{{ $jobType->id }}" id="job-Type-{{ $jobType->id }}">    
//                            <label class="form-check-label " for="job-Type-{{ $jobType->id }}">Full Time</label>
//                        </div>


//                        @endforeach
                   
//                        @endif
//                     </div>

//                     <div class="mb-4">
//                         <h2>Experience</h2>
//                         <select name="experience" id="experience" class="form-control">
//                             <option value="">Select Experience</option>
//                             <option value="">1 Year</option>
//                             <option value="">2 Years</option>
//                             <option value="">3 Years</option>
//                             <option value="">4 Years</option>
//                             <option value="">5 Years</option>
//                             <option value="">6 Years</option>
//                             <option value="">7 Years</option>
//                             <option value="">8 Years</option>
//                             <option value="">9 Years</option>
//                             <option value="">10 Years</option>
//                             <option value="">10+ Years</option>
//                         </select>
//                     </div>                    
//                 </div>

//             </form>




