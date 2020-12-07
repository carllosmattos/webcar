<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{

    public function getSectors()
    {
        $sectors = Sector::all();
        return $sectors;
    }


    // Um setor tem muitos usuário
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
