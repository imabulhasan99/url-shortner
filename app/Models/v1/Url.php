<?php

namespace App\Models\v1;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['full_url','short_url','user_id', 'views'] ;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
