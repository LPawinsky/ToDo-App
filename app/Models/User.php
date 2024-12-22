<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';

    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getTasksWithFilteredOptions(array $filters): Collection
    {
        $query = $this->tasks();
        $filterMap = [
            'priority' => function ($query, $value) {
                $query->where('priority', $value);
            },
            'status' => function ($query, $value) {
                $query->where('status', $value);
            },
            'start_date' => function ($query, $value) {
                $query->whereDate('due_date', '>=', $value);
            },
            'end_date' => function ($query, $value) {
                $query->whereDate('due_date', '<=', $value);
            },
        ];

        foreach ($filters as $filter => $value) {
            if (isset($filterMap[$filter]) && !empty($value)) {
                $filterMap[$filter]($query, $value);
            }
        }

        return $query->get();
    }
}
