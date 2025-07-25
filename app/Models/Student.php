<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
        'email',
        'gender',
        'class_id',
    ];

    public function class()
    {
        return $this->belongsTo(Kelas::class, 'class_id');
    }
}