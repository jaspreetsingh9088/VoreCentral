<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\Creator;
use App\Models\Tagoption;
use App\Models\Tag;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $username;
    public $email;
    public $gender;
    public $sexual_orientation;
    public $role_preference;
    public $dob;
    public $about;
    public $rpstatus;
    public $ip_address;
    public $latitude;
    public $longitude;
    public $profile_pic;
    public $cover_pic;
    public $stripe_status;
    public $paypal;
    public $content_type;
    public $old_account;
    public $content_description;
    public $subgenres;
    public $myselecttag;
    public $myselectantitag;

    public function __construct()
    {
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
        $this->gender = Auth::user()->gender;
        $this->sexual_orientation = Auth::user()->sexual_orientation;
        $this->role_preference = Auth::user()->role_preference;
        $this->dob = Auth::user()->dob;
        $this->about = Auth::user()->about;
        $this->rpstatus = Auth::user()->rpstatus;
        $this->ip_address = Auth::user()->ip_address;
        $this->latitude = Auth::user()->latitude;
        $this->longitude = Auth::user()->longitude;
        $this->profile_pic = Auth::user()->profile_pic;
        $this->cover_pic = Auth::user()->cover_pic;
        $this->stripe_status = Auth::user()->stripe_status;
        
    
    }
    public function build()
    {
        return $this->subject('Personal Data')->view('mail.personal_data');
    }
}
