<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function contact(){
        return view('frontend.contact');
    }

    public function storemessage(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ],
        [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter a valid email',
            'subject.required' => 'Please enter your subject',
            'phone.required' => 'Please enter your phone number',
            'message.required' => 'Please enter your message',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->created_at = Carbon::now();
        $contact->save();

        $notification = array(
            'message' => 'Your message has been sent successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function admincontactmessages(){
        $contacts = Contact::latest()->get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function admincontactmessagedelete($id){
        Contact::find($id)->delete();
        $notification = array(
            'message' => 'Message deleted successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
