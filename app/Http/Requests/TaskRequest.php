<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    private const VALIDATE_NAME = 'required|string|max:255';
    private const VALIDATE_DESCRIPTION = 'nullable|string';
    private const VALIDATE_PRIORITY = 'required|in:low,medium,high';
    private const VALIDATE_STATUS = 'required|in:to-do,in progress,done';
    private const VALIDATE_DUE_DATE = 'required|date|after_or_equal:today';

    public function rules(): array
    {
        return [
            Task::NAME => self::VALIDATE_NAME,
            Task::DESCRIPTION => self::VALIDATE_DESCRIPTION,
            Task::PRIORITY => self::VALIDATE_PRIORITY,
            Task::STATUS => self::VALIDATE_STATUS,
            Task::DUE_DATE => self::VALIDATE_DUE_DATE
        ];
    }
}
