<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'category_name',
        'created_at',
        'updated_at',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
