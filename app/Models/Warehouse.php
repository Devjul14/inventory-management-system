<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory, Sortable;


    protected $fillable = [
        'warehouse_name',
        'location',
        'size_capacity',
    ];

    protected $guarded = [
        'id',
    ];

    public $sortable = [
        'warehouse_name',
        'location',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('warehouse_name', 'like', '%' . $search . '%')->orWhere('location', 'like', '%' . $search . '%');
        });
    }
}
