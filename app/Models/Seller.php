<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'company_name'
    ];

    protected $guarded = [
        'id',
    ];

    public $sortable = [
        'company_name'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('company_name', 'like', '%' . $search . '%');
        });
    }
}
