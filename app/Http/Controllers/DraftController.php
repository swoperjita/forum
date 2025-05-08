<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function index()

    {
        if (!auth()->check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
            
        $drafts = Post::where('is_draft', true)
                      ->where('user_id', auth()->id()) // Only fetch drafts of the current user
                      ->get();

        // Pass drafts to the view for display
        return view('drafts.index', ['drafts' => $drafts]);
        
    }
}

