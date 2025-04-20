<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Motivation extends Model
{
    use HasFactory;

    protected $table = 'motivations';

    protected $fillable = [
        'id_user',
        'id_kategori',
        'isi_motivasi',
        'tanggal_input',
        'tanggal_update'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
