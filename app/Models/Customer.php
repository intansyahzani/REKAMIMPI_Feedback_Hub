<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name'];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
