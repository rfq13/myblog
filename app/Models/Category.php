<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Category extends Model
{
    use HasFactory;

    protected $appends = ['modified','test'];

    public function test()
    {
        return $this->get();
    }

    public function getModifiedAttribute()
    {
        Carbon::setLocale('us');
        return $this->attributes['modified'] = Carbon::parse($this->updated_at)->format('Y-m-d H:i:s');
    }
    public function getTestAttribute()
    {
        return $this->attributes['test'] = $this->id+1;
    }

    public function post()
    {
        return $this->hasMany(Post::class, 'category');
    }
}
