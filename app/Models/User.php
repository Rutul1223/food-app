<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;
use Laravel\Cashier\Billable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory, Billable, Notifiable, LogsActivity;


    public function tapActivity(Activity $activity, string $eventName)
    {
        // Use custom log description if set, otherwise use default
        $activity->description = $this->customLogDescription
            ? $this->customLogDescription
            : "User '{$this->name}' has been {$eventName}";

        $activity->event = $eventName;

        // Convert properties to array if it's a collection
        $propertiesArray = is_array($activity->properties) ? $activity->properties : $activity->properties->toArray();

        // Merge the new properties with the existing properties
        $activity->properties = array_merge($propertiesArray, [
            'ip_address' => Request::ip(),
            'browser_info' => Request::header('User-Agent'),
        ]);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email']) // Specify the attributes you want to log
            ->logOnlyDirty() // Only log if attributes have changed
            ->dontSubmitEmptyLogs(); // Prevent empty logs
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',  // Add this
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function comments()
    {
        return $this->hasMany(comment::class, 'sender_id', 'id');
    }
}
