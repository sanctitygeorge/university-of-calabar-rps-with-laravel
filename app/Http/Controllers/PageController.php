<?php

namespace App\Http\Controllers;
use App\Contact;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about(){
        return view('pages.about');
    }

    public function contact(){
    
        return view('pages.contact');
    }


    public function news(){
    
        return view('pages.news');
    }



    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
             ));
    
            $contact = new Contact;
            $contact->name = $request->name;
            $contact->subject  = $request->subject;
            $contact->description  = $request->description;
            $contact->phone  = $request->phone;
            $contact->email  = $request->email;
           
            $contact->save();
    
      return redirect()->route('contact')->with('success_message', 'Dear User, your message has being received!!');
    }
}
