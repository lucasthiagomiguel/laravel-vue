<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','password'];

    public function rules(){
        return 
        [ 
        'email' => 'required|unique:users,email,'.$this->id.''
        ];
    }

    public function feedback(){
        return 
        [
            'required' => 'input email required',
            'email.unique' => ' email exist'
        ];
    }

    public function tasks(){
        return $this->hasMany('App\Models\Task');
    }
}
