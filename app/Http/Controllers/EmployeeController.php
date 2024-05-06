<?php 

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Mail\CustomResetPassword;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller {
    function profile_page() {
        // Get the authenticated user
        $user = auth()->user();

        // Fetch the profile data for the logged-in user
        $employee = Profile::where('user_id', $user->id)->first();

        // Check if the user has a company user record
        if ($user->companyUser) {
            // Get the company ID from the user's company user record
            $companyId = $user->companyUser->CompanyID;

            // Fetch profiles belonging to the specified company ID
            $profiles = Profile::join('companyusers', 'profiles.user_id', '=', 'companyusers.UserID')
                ->where('companyusers.CompanyID', '=', $companyId)
                ->get();

            // Pass the profiles to the view
            return view('employee.profile-page', compact('user', 'employee', 'profiles'));
        }

        // Handle the case when the user doesn't have a company user record
        return redirect()->route('login')->with('error', 'User does not have a company association.');
        return view('employee.profile-page');
    }

}
    function login_page() {
        return view('employee.login-page');
    }

?>
