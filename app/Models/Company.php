<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    protected $fillable = [
        'name',
        'email',
        'tel',
        'web',
        'bio',
        'photo',
        'tasks_id'
    ];

public function tasks()
{
    return $this->hasMany(Task::class);
}

}
