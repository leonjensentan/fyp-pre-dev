<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function homepageName()
    {
        // Fetch a single post from the database in random order
        $randomPost = Post::inRandomOrder()->first();

        // If a post is found
        if ($randomPost) {
            // Retrieve the user ID associated with the fetched post
            $userId = $randomPost->UserID;

            // Find the user from the users table using the retrieved user ID
            $user = User::find($userId);

            // If user is not found
            if (!$user) {
                // Log an error or handle the case appropriately
                \Log::error('User not found with ID: ' . $userId);
            }

            // Pass the fetched post and user to the view
            return view('discussion.homepage', ['randomPost' => $randomPost, 'user' => $user]);
        } else {
            // If no post is found, return a view with no data
            return view('discussion.homepage');
        }
    }

    // Other controller methods...
}
