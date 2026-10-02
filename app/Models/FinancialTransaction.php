<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'reference_id', 'registered_at', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'reference_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'reference_id');
    }
}
