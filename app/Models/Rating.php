<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $table = 'rating';
    protected $fillable = ['id', 'rating', 'user', 'buku_id'];
    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }
}
