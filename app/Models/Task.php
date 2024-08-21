<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;


/**
 * @OA\Schema(
 *      schema="Task",
 *      @OA\Property(property="id", type="integer", description="Task ID", example=1),
 *      @OA\Property(property="title", type="string", description="Task title", example="Complete project"),
 *      @OA\Property(property="description", type="string", description="Task description", example="Finish the project by the end of the week."),
 *      @OA\Property(property="status", type="string", description="Task status", example="in-progress"),
 *      @OA\Property(property="priority", type="string", description="Task priority", example="high"),
 *      @OA\Property(property="expiration_date", type="string", description="Expiration date", example="2024-09-10"),
 *      @OA\Property(property="created_at", type="string", description="Creation date", example="2024-08-20 12:00:00"),
 *      @OA\Property(property="updated_at", type="string", description="Last update date", example="2024-08-21 14:30:00")
 * )
 */
class Task extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function getExpirationDateAttribute($value)
    {
        $carbonDate = Carbon::parse($value);
        return Jalalian::fromCarbon($carbonDate)->format('Y/m/d');
    }

    public function setExpirationDateAttribute($value)
    {
        list($year, $month, $day) = explode('/', $value);
        $gregorianDate = Jalalian::fromFormat('Y/m/d', $value)->toCarbon();
        $this->attributes['expiration_date'] = $gregorianDate->toDateString();
    }

    public function getPriorityAttribute($value)
    {
        return __('attributes.priority.' . $value);
    }

    public function setPriorityAttribute($value)
    {
        $translation = [
            'بالا' => 'high',
            'متوسط' => 'medium',
            'پایین' => 'low',
        ];

        if (array_key_exists($value, $translation)) {
            $this->attributes['priority'] = $translation[$value];
        } else {
            $this->attributes['priority'] = $value;
        }
    }


    public function getStatusAttribute($value)
    {
        return __('attributes.status.' . $value);
    }

    public function setStatusAttribute($value)
    {
        $translation = [
            'در حال انجام' => 'in_progress',
            'کامل شده' => 'completed',
            'به تعویق افتاده' => 'deferred',
        ];
        if (array_key_exists($value, $translation)) {
            $this->attributes['status'] = $translation[$value];
        } else {
            $this->attributes['status'] = $value;
        }
    }

    
}
