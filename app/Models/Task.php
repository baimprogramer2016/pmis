<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $appends = ["open"];
 
    public function getOpenAttribute(){
        return true;
    }
    protected $table = 'Tasks';

    public function r_parent()
    {
        return $this->hasOne(Task::class,  'id', 'parent');
    }
}
