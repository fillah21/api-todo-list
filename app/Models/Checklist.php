<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checklist extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function todo() : HasMany {
        return $this->hasMany(Todo::class, 'checklist_id');
    }
}
