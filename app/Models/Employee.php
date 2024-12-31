<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'image',
        'position',
        'division_id'
    ];

    /**
     * Define the relationship to Division (Many-to-One).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Customize the array representation of the model.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'image' => $this->image ? url($this->image) : null,
            'name' => $this->name,
            'phone' => $this->phone,
            'division' => $this->division ? $this->division : null,
            'position' => $this->position,
        ];
    }
}
