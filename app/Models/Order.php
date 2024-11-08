<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'price', 'total_amount', 'address']) // Log only specific fields
            ->logOnlyDirty() // Only log changes
            ->dontSubmitEmptyLogs(); // Prevent empty logs
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = "Order has been {$eventName} by {$activity->causer->name}";
        $activity->event = $eventName;

        $activity->properties = array_merge($activity->properties->toArray(), [
            'ip_address' => Request::ip(),
            'browser_info' => Request::header('User-Agent'),
        ]);
        $activity->causer_id = auth()->id();
        $activity->causer_type = User::class;
    }

    protected $fillable = [
        'total_amount',
        'address',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class, 'order_id', 'id'); // Define the relationship with explicit keys
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'order_id', 'id'); // Assumes order_id is the foreign key in comments
    }
}
