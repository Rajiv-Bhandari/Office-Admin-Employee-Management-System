<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Mail\Message;
use App\Jobs\EmailQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Middleware\CheckSessionExpiration;

class AuthController extends Controller
{
    public function showLoginForm()
    {

        return view('login');
    }
    public function contatpage()
    {
        return view('staff.contatpage');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if ($credentials['email'] === 'admin' && $credentials['password'] === 'admin') {
        // Admin authentication successful
        return view('home');
    } else {
        $staff = Staff::where('email', $credentials['email'])->first();
        
        if ($staff && Hash::check($credentials['password'], $staff->password)) {
            // Staff authentication successful
            auth()->login($staff);

            // Generate a new session token
            $sessionToken = Str::random(60);

            // Store the new session token in the session
            $request->session()->put('session_token', $sessionToken);

            // Update the user's session_token with the new session token
            $staff->update(['session_token' => $sessionToken]);

            

            // Redirect to the staff member's dashboard or homepage
            return view('staff.home');
        } else {
            // Invalid email or password
            return back()->withInput()->withErrors('Invalid email or password');
        }
    }
}



public function logout()
{
    $user = Auth::user();
    $staff = Staff::find(Auth::id()); 
    $staff->update(['session_token' => null]);
    // if ($user instanceof Staff) {
        
    //     $user->update(['session_token' => null]);
    // }
    
    Auth::logout();
    \session()->invalidate();
    \session()->regenerateToken();

    return \redirect('/login');
}


    public function createPage()
    {
        return view("home");
    }
    public function staffdepartmentdetails()
    {
        $department = Department::all();
        return view("department.staffdepartment", ['department' => $department]);
    }
    public function staffviewstaff()
    {
        $departmentId = Auth::user()->dept_id;
        $staff = Staff::where('dept_id', $departmentId)->get();
        return view("staff.staffviewstaff", compact('staff'));
    }

    public function staffprofile(Request $request)
    {
        if (Auth::check()) {
            $staff = Auth::user();
            $departmentName = Department::where('id', $staff->dept_id)->value('name');
            return view('staff.profile', compact('staff', 'departmentName'));
        } else {
            return redirect()->route('login')->with('message', 'Please log in to view this page.');
        }
    }
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'dob' => 'required|date',
            'address' => 'required',
        ]);

        $staff = Staff::find(Auth::id()); // Retrieve the authenticated user using their ID

        $staff->update([
            'name' => $validatedData['name'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
        ]);

        return redirect()->route('staffprofile')->with('success', 'Profile updated successfully!');
    }
    public function updatepassword(Request $request)
    {
        $validatedData = $request->validate([
            'CurrentPassword' => 'required',
            'NewPassword' => 'required',
            'ConfirmPassword' => 'required',
        ]);
    
        $staff = Auth::user();
        $staffpassword = $staff->password;
        $hashedpassword = Hash::check($validatedData['CurrentPassword'], $staffpassword);
        $staffid = Staff::find(Auth::id());
        if ($hashedpassword) {
            if($validatedData['CurrentPassword'] === $validatedData['NewPassword']){
                return redirect()->route('changepassword')->with('success', 'Current Password and New Password cannot be same!');
            }
            if ($validatedData['NewPassword'] === $validatedData['ConfirmPassword']) {
                $staff->password = Hash::make($validatedData['ConfirmPassword']);
                //$staff->save();
                $staffid->update(['password' => $staff->password]);
                return redirect()->route('logout')->with('success', 'Password changed successfully');
            } else {
                return redirect()->route('changepassword')->with('success', 'New password and confirm password are not the same!');
            }
        } else {
            return redirect()->route('changepassword')->with('success', 'Please enter the correct current password!');
        }
    }



    public function homepage()
    {
        return view("home");
    }

    public function changepassword()
    {
        return view("staff.changepassword");
    }
    
    public function createDepartment()
    {
        $department = Department::all();
        return view('department.create', ['department' => $department]);
    }

    
    public function createStaff()
    {
        $department = Department::all();
        return view('staff.create', compact('department'));
    }

    public function staffhome()
    {
        return view('staff.home');
    }

    public function adminedit(Department $department)
    {
        return view('department.adminedit', ['department' => $department]);
    }
    public function staffadminedit(Staff $staff, Department $department)
    {
        $department=Department::all();
        return view('staff.adminedit', ['staff' => $staff],compact('department'));
    }
    public function adminupdate(Department $department, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'short_code' => 'required'
        ]);
        
        $department->update($data);
        return redirect(route('details'))->with(
            'success',
            "Updated Department Successfully"
        );
    }
    public function staffdetailsupdate(Staff $staff, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'status' => 'required',
            'dept_id' => 'required'
        ]);
        
        $staff->update($data);
        return redirect(route('staffdetails'))->with(
            'success',
            "Updated Staff Details Successfully"
        );
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'short_code' => 'required'
        ]);

        $newdepartment = Department::create($data);

        return redirect(route('details'))->with(
            'success',
            "Added new department"
        );
    }

    public function staffstore(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'dob' => 'required',
        'address' => 'required',
        'password' => 'required',
        'password_confirmation' => 'required',
        'status' => 'required',
        'dept_id' => 'required',
    ]);

    if ($data['password'] === $data['password_confirmation']) {
        $department = Department::findOrFail($data['dept_id']);
        $staffCount = Staff::where('dept_id', $department->id)->count();

        $shortCode = $department->short_code . sprintf('%02d', $staffCount + 1);

        $data['short_code'] = $shortCode;
        $data['password'] = Hash::make($data['password']);
        $newStaff = Staff::create($data);

        // Dispatch the EmailQueue job
        EmailQueue::dispatch($request->name, $request->email);

        return redirect(route('staffdetails'))->with(
            'success',
            "Created New Staff"
        );
    } else {
        return redirect(route('staff.create'))->with(
            'success',
            "Password and Confirm Password must match"
        );
    }
}

    


    public function showDep()
    {
        $department = Department::all();

        return view('details', ['department' => $department]);
    }
    
    public function showStaff(Department $department)
    {
        $staff = Staff::all(); 
        return view('staffdetails', ['staff' => $staff, 'department' => $department]);
        
    }


    public function destroy(Department $department){
        $department->delete();
        return redirect(route('details'))->with(
            'success',
            "Deleted a department"
        );
    }
    public function staffdestroy(Staff $staff){
        $staff->delete();
        return redirect(route('staffdetails'))->with(
            'success',
            "Deleted a staff"
        );
    }
    public function sendmail(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'title' => 'required',
        'description' => 'required',
    ]);

    // Send email to admin
    Mail::send([], [], function (Message $message) use ($request) {
        $name = session('staff');
        $message->from($request->email, $name); 
        $message->to('bhandarirajiv22@gmail.com');
        $message->subject($request->title);
        // Set the email body as HTML
        $message->html('<p>' . nl2br(e($request->description)) . '</p>');
    });

    // Redirect to a new page
    return redirect(route('staff.home'))->with(
        'success',
        "Mail Sent Successfully"
    );
    }

}