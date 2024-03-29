<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Table extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tableRows(): hasMany
    {
        return $this->hasMany(TableRow::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
