<?php

return [
    "pg_default" => 10,
    "url_segment" => 2,
    'STRIPE_KEY' => env("STRIPE_PUBLIC_KEY"),
    'STRIPE_SECRET' => env("STRIPE_SECRET_KEY"),
];
