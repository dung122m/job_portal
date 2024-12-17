<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobType;
use App\Models\SavedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{


    public function create()
    {
        $user       = auth()->user(); // Lấy thông tin user đang đăng nhập
        $categories = Category::where('status', 1)->get(); // Lấy tất cả các category
        $jobTypes   = JobType::where('status', 1)->get(); // Lấy tất cả các job types
        return view('front.job.create', compact('categories', 'jobTypes', 'user'));
    }

    public function store(Request $request)
    {

        // Validate dữ liệu

        $request->validate([
            'title'            => 'required|string|max:255',
            'category_id'      => 'required|exists:categories,id',
            'job_type_id'      => 'required|exists:job_types,id',
            'vacancy'          => 'required|integer|min:1',
            'salary'           => 'nullable|string',
            'location'         => 'required|string|max:255',
            'description'      => 'required|string',
            'benefits'         => 'nullable|string',
            'responsibility'   => 'nullable|string',
            'qualifications'   => 'nullable|string',
            'keywords'         => 'nullable|string|max:255',
            'company_name'     => 'required|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'website'          => 'nullable|url',
        ]);

        // Tạo mới job
        Job::create([
            'title'            => $request->title,
            'category_id'      => $request->category_id,
            'job_type_id'      => $request->job_type_id,
            'user_id'          => auth()->id(),
            'vacancy'          => $request->vacancy,
            'salary'           => $request->salary,
            'location'         => $request->location,
            'description'      => $request->description,
            'benefits'         => $request->benefits,
            'responsibility'   => $request->responsibility,
            'qualifications'   => $request->qualifications,
            'keywords'         => $request->keywords,
            'experience'       => $request->experience,
            'company_name'     => $request->company_name,
            'company_location' => $request->company_location,
            'company_website'  => $request->company_website,
        ]);

        session()->flash('success', 'Create job successfully');
        return redirect()->back();
    }

    public function myJobs()
    {
        $user = auth()->user(); // Lấy thông tin user đang đăng nhập
        $jobs = Job::where('user_id', $user->id)->with('jobType')->orderBy('created_at', 'DESC')->paginate(5);
        $applicantsCount = JobApplication::whereIn('job_id', $jobs->pluck('id'))
            ->select('job_id', DB::raw('count(*) as count'))
            ->groupBy('job_id')
            ->pluck('count', 'job_id');



        return view('front.job.my-job', [
            'jobs' => $jobs,
            'user' => $user,
            'applicantsCount' => $applicantsCount
        ]);
    }

    public function details($id)
    {
        $job = Job::where('id', $id)->with('jobType')->first();
        return view('front.job.details', [
            'job' => $job
        ]);
    }

    public function edit($id)
    {
        $user = auth()->user(); // Lấy thông tin user đang đăng nhập
        $job = Job::where('id', $id)->with('jobType')->first();

        // Kiểm tra quyền sở hữu
        if ($job->user_id !== $user->id) {
            return redirect()->route('job.my-job')->with('error', 'You are not authorized to edit this job.');
        }

        $categories = Category::where('status', 1)->get(); // Lấy tất cả các category
        $jobTypes   = JobType::where('status', 1)->get();  // Lấy tất cả các job types

        return view('front.job.edit', [
            'job'        => $job,
            'categories' => $categories,
            'jobTypes'   => $jobTypes,
            'user'       => $user
        ]);
    }


    public function update(Request $request, $id)
    {
        // Tìm job theo id
        $job = Job::findOrFail($id);

        // Kiểm tra quyền sở hữu
        if ($job->user_id !== auth()->id()) {
            return redirect()->route('job.my-job')->with('error', 'You are not authorized to update this job.');
        }

        // Validate dữ liệu tương tự như trong phương thức store
        $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,id',
            'job_type_id'    => 'required|exists:job_types,id',
            'vacancy'        => 'required|integer|min:1',
            'salary'         => 'nullable|string',
            'location'       => 'required|string|max:255',
            'description'    => 'required|string',
            'benefits'       => 'nullable|string',
            'responsibility' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'keywords'       => 'nullable|string|max:255',

            'company_name'     => 'required|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'company_website'  => 'nullable|url',
        ]);

        // Cập nhật job
        $job->update([
            'title'            => $request->title,
            'category_id'      => $request->category_id,
            'job_type_id'      => $request->job_type_id,
            'vacancy'          => $request->vacancy,
            'salary'           => $request->salary,
            'location'         => $request->location,
            'description'      => $request->description,
            'benefits'         => $request->benefits,
            'responsibility'   => $request->responsibility,
            'qualifications'   => $request->qualifications,
            'keywords'         => $request->keywords,
            'experience'       => $request->experience,
            'company_name'     => $request->company_name,
            'company_location' => $request->company_location,
            'company_website'  => $request->company_website,
        ]);

        session()->flash('success', 'Job updated successfully');
        return redirect()->route('job.edit', $id);
    }


    public function destroy($id)
    {
        $job = Job::findOrFail($id); // Tìm job với ID tương ứng
        $job->delete(); // Xóa job

        return redirect()->back()->with('success', 'Job deleted successfully'); // Chuyển hướng về trang danh sách công việc với thông báo
    }


    // Lấy danh sách công việc theo danh mục
    public function index(Request $request)
    {
        // Lấy dữ liệu từ request
        $keywords   = $request->input('keywords');
        $location   = $request->input('location');
        $category   = $request->input('category');
        $jobType    = $request->input('job_type', []); // mảng các loại hình công việc
        $experience = $request->input('experience');
        $jobTypes   = \App\Models\JobType::all();
        $categories = \App\Models\Category::all();
        // Lấy danh sách việc làm từ database (giả sử bạn đã có model Job)
        $jobs = \App\Models\Job::query();

        // Áp dụng các bộ lọc
        if ($keywords) {
            $jobs->where('title', 'like', "%{$keywords}%");
        }

        if ($location) {
            $jobs->where('location', 'like', "%{$location}%");
        }

        if ($category) {
            $jobs->where('category_id', $category); // giả sử có trường category_id trong bảng jobs
        }

        if (!empty($jobType)) {
            $jobs->whereIn('job_type_id', $jobType); // giả sử có trường job_type trong bảng jobs
        }

        if ($experience) {
            $jobs->where('experience', '<=', $experience); // giả sử có trường experience trong bảng jobs
        }

        // Lấy dữ liệu việc làm
        $jobs = $jobs->paginate(6); // Phân trang, 10 công việc mỗi trang

        // Trả về view với dữ liệu
        return view('front.job.index', compact('jobs', 'categories', 'jobTypes'));
    }

    public function apply(Request $request)
    {
        $job = Job::findOrFail($request->id);
        $employer_id = $job->user_id;

        // Không cho phép người dùng apply vào công việc của chính họ
        if ($employer_id == auth()->id()) {
            return redirect()->back()->with('error', 'You cannot apply for your own job.');
        }

        // Kiểm tra xem người dùng đã apply cho công việc này chưa
        $existingApplication = JobApplication::where('job_id', $request->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // Tạo bản ghi mới trong bảng JobApplication
        $jobApplication = JobApplication::create([
            'job_id'      => $request->id,
            'user_id'     => auth()->id(),
            'employer_id' => $employer_id,
            'applied_date'  => now(),
        ]);

        // Đặt flash message thành công
        session()->flash('success', 'You have successfully applied for the job.');
        return redirect()->back()->with('success', 'You have successfully applied for the job.');
    }

    public function jobApplied()
    {
        $user = auth()->user();
        $jobApplied = Job::whereHas('jobApplications', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('jobApplications')->paginate(5);

        return view('front.job.applied', [
            'jobApplied' => $jobApplied,
            'user'       => $user,

        ]);
    }

    public function save(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        // Kiểm tra xem công việc này đã được lưu bởi người dùng chưa
        $existingSavedJob = SavedJob::where('job_id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingSavedJob) {
            return redirect()->back()->with('error', 'You have already saved this job.');
        }

        // Tạo bản ghi lưu công việc
        SavedJob::create([
            'job_id' => $job->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Job saved successfully.');
    }

    // Hiển thị danh sách các công việc đã lưu
    public function jobSaved()
    {
        $user = auth()->user();
        $savedJobs = Job::whereHas('savedJobs', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('savedJobs')->paginate(5);

        return view('front.job.saved', compact('savedJobs','user'));
    }

    public function viewApplicants($id)
    {
        $user = auth()->user();
        // Lấy thông tin job theo ID và kiểm tra quyền sở hữu
        $job = Job::where('id', $id)->with('jobApplications')->first();

        // Kiểm tra nếu job không tồn tại hoặc không phải là của người dùng hiện tại
        if (!$job || $job->user_id !== auth()->id()) {
            return redirect()->route('job.my-job')->with('error', 'You are not authorized to view applicants for this job.');
        }

        // Lấy danh sách người đã apply và loại bỏ các mục trùng lặp
        $applicants = $job->jobApplications()->with('user')->distinct()->get();

        return view('front.job.applicants', [
            'job' => $job,
            'applicants' => $applicants,
            'user' => $user
        ]);
    }





}


