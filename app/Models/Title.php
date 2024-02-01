<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class, 'jurusan_id');
    }

    public function pem_i()
    {
        return $this->belongsTo(Teacher::class, 'pembimbing_i');
    }
    public function pem_ii()
    {
        return $this->belongsTo(Teacher::class, 'pembimbing_ii');
    }
    public function pen_i()
    {
        return $this->belongsTo(Teacher::class, 'penguji_i');
    }
    public function pen_ii()
    {
        return $this->belongsTo(Teacher::class, 'penguji_ii');
    }
}
