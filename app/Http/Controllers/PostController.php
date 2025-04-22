<?php
namespace App\Http\Controllers;

use auth;
use view;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\SendEmailNotification;
use App\Models\UserBlock;
use App\Models\Draft;

class PostController extends Controller
{   
    public function actuallyUpdatePost(Post $post, Request $request){
        if (auth()->user()->id!==$post ['user_id']){
            return redirect('/home');
        }
        $incomingFields = $request->validate([
            'title'=>'required',
            'body'=> 'required'
        ]);
        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['body']=strip_tags($incomingFields['body']);
        $post->update($incomingFields);
        return redirect('/home');


    }
    public function showEditScreen(Post $post){
        if (auth()->user()->id!==$post ['user_id']){
            return redirect('/home');
        }
        return view('edit-post',['post'=>$post]);

    }
    
    public function deletePost(Post $post) {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();
        }
        return redirect('/home');
    }
    public function createPost(Request $request)
{
    // Define fixed categories
    $fixedCategories = ['sports', 'movie', 'question']; // Add more categories as needed

    // Validate incoming fields
    $incomingFields = $request->validate([
        'title' => 'required',
        'body' => 'required',
        'category' => 'required|string|in:' . implode(',', $fixedCategories), // Validate category against fixed categories
    ]);

    // Strip HTML tags from title and body
    $incomingFields['title'] = strip_tags($incomingFields['title']);
    $incomingFields['body'] = strip_tags($incomingFields['body']);

    // Set user_id, anonymous, and category fields
    $incomingFields['user_id'] = auth()->id();
    $incomingFields['anonymous'] = $request->has('anonymous');
    $incomingFields['category'] = $request->category; // Set category


    // Create the post
    Post::create($incomingFields);

    // Redirect to the home page
    return redirect('/home');
}
public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category'); // Get the category from the request
    
        // Perform a search query to find posts by title and category
        $posts = Post::query();
    
        if (!empty($category)) {
            $posts->where('category', $category);
        }
    
        $posts = $posts->where('title', 'like', "%$query%")->get();
    
        // Pass the search results to the view
        return view('search_results', ['posts' => $posts]);
    }
    public function confirmDel(User $user)
    {
        if (auth()->user()->id === $user->id) {
            // Retrieve all posts associated with the user
            $posts = Post::where('user_id', $user->id)->get();
    
            // Delete each post
            foreach ($posts as $post) {
                $post->delete();
            }

    
            // Delete the user account
            $user->delete();
        }
        return redirect('/home');
    }
    public function deleteacc(User $user)
    {
    if (auth()->user()->id === $user->id) {
        
        return view('confirm-delete-account', compact('user'));
    }
    return redirect('/home');

    }

    public function sendnotifications()
    {
        // Fetch only the most recently created user
        $user = User::latest()->first();
    
        
        if (auth()->check()) {
            // Customize the greeting to use the user's name
            $details = [
                'greeting' => 'হ্যালো ' . $user->name.',',
                'body' => 'আপনি সফলভাবে আমাদের ওয়েবসাইটে নিবন্ধন করেছেন। ফোরামে ফিরে যেতে, এই বাটনে ক্লিক করুন.',
                'lastline' => 'ধন্যবাদ।'
            ];
    
            Notification::send($user, new SendEmailNotification($details));
            return view('verification-confirmation');
        }
        
        
    }
    
    public function show($id)
    {
        $post = Post::with('comments')->find($id);
        return view('post.show', compact('post'));
    }

    public function markSolved(Post $post)
{
    // Check if the authenticated user is the owner of the post
    if (auth()->id() !== $post->user_id) {
        // Toggle the solved status of the post
        $post->update(['solved' => !$post->solved]);
    }

    // Redirect back to the post view
    return redirect()->back();
}
    public function report(Post $post)
    {
        
        $post->reported = true;
        $post->save();

        // return view('admin')->with('post', $post);
        return back()->with('success', 'Post reported successfully.');
    }


}