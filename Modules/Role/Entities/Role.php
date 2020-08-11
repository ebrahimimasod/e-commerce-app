<?php

namespace Modules\Role\Entities;



use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'id',
        'name'
    ];


    //region Relations
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
