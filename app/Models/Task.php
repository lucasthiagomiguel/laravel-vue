<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['users_id','name','date_conclusion','status'];

    public function rules(){
        return 
        [ 
            'users_id' => 'exists:users,id',
            'name' => 'required|unique:tasks,name,'.$this->id.'',//unique task name
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
    public function task(){
        return $this->belongsTo('App\Models\Users');
    }
}
