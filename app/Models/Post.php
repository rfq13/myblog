<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use \Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $appends = ['content_limit','modified'];

    public function getContentLimitAttribute()
    {
        // return $this->attributes['content_limit'] = Str::limit($this->content,150);
    }
    public function getModifiedAttribute()
    {
        Carbon::setLocale('id');
        return $this->attributes['modified'] = Carbon::parse($this->updated_at)->isoFormat('dddd, D MMM Y');
    }
}
