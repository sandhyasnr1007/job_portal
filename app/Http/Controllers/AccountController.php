<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Job;



class AccountController extends Controller
{
    //This method will show user registrartion page
    public function registration(){

        return view('front.account.registration');
            }
        
        
            //This method will save a user
        public function processRegistration(Request $request){
        $validator = Validator::make($request->all(),[
        
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);
        
        if ($validator->passes()){
        
            $user = new User();
            $user ->name = $request->name;    
            $user ->email = $request->email;
            $user ->password = Hash::make($request->password);
            $user->save();
        
            session()->flash('success', 'You have registered successfully.');
        
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        
        }
        else{
            return response()->json([
        'status' => false,
        'errors' => $validator->errors()
        
            ]);
        }
        }
        
         //This method will show user login page
            
            public function login(){
        
                return view('front.account.login');
            }
        
            //Authenticate user
            public function authenticate(Request $request){
                $validator = validator::make($request->all(), [
                    'email'=> 'required|email',
                    'password'=> 'required'
                ]);
        
                if ($validator->passes()){
                    if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
                        return redirect()->route('account.profile');
                    }
                    else{
        
                        return redirect()->route('account.login')
                        ->with('error','Invalid email or password');
        
                    }
            } 
            else{
                return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        
        }
           
            }
        
        //This method will show user profile page
        
        public function profile(){
          $id =  Auth::user()->id;
        // dd($id);
        $user =User::where('id', $id)->first();
        // $user =User::find($id);


            return view('front.account.profile', ['user' => $user] ); // or whatever view you're using
        }
        
        public function updateProfile(Request $request){
            $id = Auth::user()->id;
            $validator = validator::make($request->all(), [
                'name'=> 'required|min:5|max:20',
                'email'=> 'required|email|unique:users,email,'.$id.',id',
            ]);

            if($validator->passes())
            {
                $user =User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->mobile= $request->mobile;
                $user->designation= $request->designation;
                $user->save();

                session()->flash('success', 'Profile updated successfully.');
                
                return response()->json([
                    'status' => true,
                    'errors' => []
                ]);

            }
            else{
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }
        }
        public function logout(){
            Auth::logout();
            return redirect()->route('account.login');
        
        }
        public function updateProfilePic(Request $request)
        {
            // dd($request->all());

            $id =Auth::user()->id;
            $validator =Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if($validator->passes()){
                $image = $request->image;
                $ext = $image->getClientOriginalExtension();
                $imageName = $id.'-'.time().'.'.$ext; //3-234556.png
                $image->move(public_path('/profile_pic'), $imageName);

                //Create a small thumbnail
                $sourcePath = public_path('/profile_pic/'   . $imageName);
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($sourcePath);

                // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
                $image->cover(150, 150);
                $image->toPng()->save(public_path('/profile_pic/thumb/'   . $imageName));


                //Delete old Profile picture
                File::delete(public_path('/profile_pic/thumb'   . Auth::user()->image));
                File::delete(public_path('/profile_pic/'   . Auth::user()->image));

                User::where('id', $id)->update(['image' => $imageName]);
                session()->flash('success', 'Profile picture updated successfully.');
                
                return response()->json([
                    'status' => true,
                    'errors' => []
                ]);

            }
            else{
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }

        }

        public function createJob(){

            $categories = Category::orderBy('name', 'ASC')->where('status',1)->get();

            $jobTypes = JobType::orderBy('name', 'ASC')->where('status',1)->get();
            return view('front.account.job.create', [
                'categories' => $categories,
                'jobTypes' => $jobTypes
            ]);
        }

        public function saveJob(Request $request) {

            $rules = [
                'title'=> 'required|min:5|max:200',
                'category'=> 'required',
                'job_type'=> 'required',
                'vacancy'=> 'required|integer',
                'location'=> 'required|max:50',
                'description'=> 'required',
                'company_name'=> 'required|min:3|max:75',

            ];

            $validator = Validator::make($request->all(),); 

            if ($validator->passes()) {
                $job = new Job();
                $job->title = $request->title;
                $job->category_id = $request->category_id;
                $job->job_type_id = $request->job_type_id;
                $job->vacancy = $request->vacancy;
                $job->salary = $request->salary;
                $job->location = $request->location;
                $job->description = $request->description;
                $job->benefits = $request->benefits;
                $job->responsibility = $request->responsibility;
                $job->keywords = $request->keywords;
                $job->experience = $request->experience;
                $job->company_name = $request->company_name;
                $job->company_location = $request->company_location;
                $job->company_website = $request->company_website;

                $job->save();

                return response()->json([
                    'status' => true,
                    'errors' => []
                ]);



            }else{
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);

            }
                
                
            

        }
        
}
