<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentResult extends Model
{
    use HasFactory;
    protected $fillable = ['document_id','status','connect','view','nonuser_id','x','y','type','result','index','ip','city','country'];

    public function recipient()
    {
        return $this->belongsTo(Nonuser::class, 'nonuser_id');
    }

    public function getResultAttribute($value)
    {
        if($this->type == 'date' && $value) {
            return date('d/m/Y', strtotime($value));
        }
        return $value;
    }
}
