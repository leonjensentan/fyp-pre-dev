<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\CustomResetPassword;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller {
    function profile_page() {
        return view('employee.profile-page');
    }

    function login_page() {
        return view('employee.login-page');
    }

}