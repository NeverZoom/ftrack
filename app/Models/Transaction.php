<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transactions';
    protected $fillable = ['name', 'sum', 'isIncome', 'publish_date', 'category_id', 'user_id'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


}
