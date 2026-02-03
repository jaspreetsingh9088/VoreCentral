<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadDlcFIle extends Model
{
    use HasFactory;
    protected $table = "download_dlc_files";
    protected $fillable = [
        'user_id',
        'content_id',
        'download',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['deleted_at'];
}
