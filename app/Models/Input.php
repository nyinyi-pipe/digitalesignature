<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;
    protected $fillable = ['document_id','requester_id','recipient_id','content'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
    public function recipient()
    {
        return $this->belongsTo(Nonuser::class);
    }
    public function requester()
    {
        return $this->belongsTo(User::class);
    }
}
