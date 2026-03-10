<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\ApplicationType;
use App\Enums\DoseUnit;

class Application extends Model
{

    protected $casts = [
        'application_date' => 'datetime',
        'unit' => DoseUnit::class,
        'application_type' => ApplicationType::class,
    ];

    protected $fillable = [
        'application_date',
        'dose',
        'unit',
        'area_applied',
        'application_type',
        'responsible_technician',
        'notes',
        'product_id',
        'field_id',
        'crop_id',
        'created_by'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
