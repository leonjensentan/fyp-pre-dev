<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller {

    function homepage() {
        return view('discussion.homepage');
    }

    function searched() {
        return view('discussion.searched');
    }

    function typeown() {
        return view('discussion.typeown');
    }

    

}

