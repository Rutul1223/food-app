<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Food extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
    ];
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'price']) // Log only specific fields
            ->logOnlyDirty() // Only log changes
            ->dontSubmitEmptyLogs(); // Prevent empty logs
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = "Food '{$this->name}' has been {$eventName}";
        $activity->event = $eventName;

        $activity->properties = array_merge($activity->properties->toArray(), [
            'ip_address' => Request::ip(),
            'browser_info' => Request::header('User-Agent'),
        ]);
        $activity->causer_id = auth()->id();
        $activity->causer_type = User::class;
    }
}
