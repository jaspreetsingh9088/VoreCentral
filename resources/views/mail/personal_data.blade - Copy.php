<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Personal Data</title>
    </head>

    <body>
        <p style="font-weight: 600;margin: 0;">Hi {{ $username }}</p>        
        <ul>
            <li>Username - {{ $username }}</li>
            <li>Email - {{ $email }}</li>
            <li>Gender - {{ $gender }}</li>
            <li>Sexual Orientation - {{ $sexual_orientation }}</li>
            <li>Role Preference - {{ $role_preference }}</li>
            <li>Date of Birth - {{ $dob }}</li>
            <li>About - {{ $about }}</li>
            <li>Role Play status - {{ $rpstatus }}</li>
            <li>Ip Address - {{ $ip_address }}</li>
            <li>Latitude - {{ $latitude }}</li>
            <li>Longitude - {{ $longitude }}</li>
            <li>Profile Photo - {{ $profile_pic }}</li>
            <li>Cover Picture - {{ $cover_pic }}</li>
            <li>Stripe Status - {{ $stripe_status }}</li>
            <li>Paypal - {{ $paypal }}</li>
            <li>Content Type - {{ $content_type }}</li>
            <li>Old Account - {{ $old_account }}</li>
            <li>Content Description - {{ $content_description }}</li>
            <li>Subgenres - {{ $subgenres }}</li>
            @if($myselecttag!="")
            <li>My Tag - {{ $myselecttag }}</li>
            @endif
            @if($myselectantitag!="")
            <li>My Antitag - {{ $myselectantitag }}</li>
            @endif
        </ul>
        <p>Please reach out to us if you have any questions.</p>
        
    </body>
</html>
