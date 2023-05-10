<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory ,HasUuids;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = ['user_id','nonuser_id','doc_name','doc_docs','doc_type','doc_key','doc_status'];

    protected $casts = [
        'doc_docs' => 'array',
    ];
}
