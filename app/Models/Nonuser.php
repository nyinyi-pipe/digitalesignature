<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nonuser extends Model
{
    use HasFactory , HasUuids;
    protected $fillable = ['name','email','first_name','last_name'];

    public function nonuserdocuments()
    {
        return $this->belongsToMany(Document::class, 'document_nonuser');
    }

}
