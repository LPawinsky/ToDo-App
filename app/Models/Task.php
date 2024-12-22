<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    public const ID = 'id';
    public const NAME = 'name';
    public const DESCRIPTION = 'description';
    public const PRIORITY = 'priority';
    public const STATUS = 'status';
    public const DUE_DATE = 'due_date';
    public const USER_ID = 'user_id';

    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::PRIORITY,
        self::STATUS,
        self::DUE_DATE,
        self::USER_ID,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME);
    }
}
