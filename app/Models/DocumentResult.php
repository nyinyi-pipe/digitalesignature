<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentResult extends Model
{
    use HasFactory;
    protected $fillable = ['document_id','nonuser_id','x','y','type','result'];
}
