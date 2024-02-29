<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Models\CompanyUser;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function manageAccount()
    {
        // Fetch profiles of all admins
        $admins = User::whereHas('companyUser', function ($query) {
            $query->where('isAdmin', true);
        })->with('profile')->get();

        // Pass the admins to the view
        return view('superadmin.manage-account', ['admins' => $admins]);
    }

    function profile_page()
    {


        $user = auth()->user();

        // Assuming you have a 'profile' relationship in your User model
        $profile = $user->profile;

        // Check if the user has a profile
        if ($profile) {
            // Pass the user and profile to the view
            return view('superadmin.profile-page', ['user' => $user, 'profile' => $profile]);
        }

    }




}

