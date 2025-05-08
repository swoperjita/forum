<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Mail\GeneralNotification;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function sendEmail(){
        $users = User::all();

        //$toEmail= "swoperjita19@gmail.com";
        $message= "Welcome to Forum";
        $subject= "Warning";
        foreach ($users as $user) {
            Mail::to($user)->send(new GeneralNotification($message, $subject));
        
        //dd($request);
    }
    return view('another'); // Blade file: resources/views/nextpage.blade.php
}
}