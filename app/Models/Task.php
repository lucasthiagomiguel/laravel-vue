<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name','date_conclusion','status'];

    public function rules(){
        return 
        [ 
            'user_id' => 'exists:users,id',
            'name' => 'required|unique:task,name,'.$this->id.'',
            'date_conclusion' => 'required',
            'status' => 'required|boolean'
        ];
    }

    public function feedback(){
        return 
        [
            'required' => 'input name required',
            'name.unique' => ' task name already exists',
            'required' => 'input status required',
        ];
    }
}
