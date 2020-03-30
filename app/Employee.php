<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Employee extends BaseModel
{
    protected $appends = ['avatar'];

    public function getAvatarAttribute()
    {
        return url('/') .'/employees/'.$this->No.'/profile_picture/'.$this->Profile_Picture;
    }
}
