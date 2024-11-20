<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedNewsSite extends Model
{
    use HasFactory;

    protected $table ='related_news';
    protected $fillable = ['name', 'url'];
    public static function filterRequest()
    {
        return [
            'name' => 'required|max:100|string',
            'url' => 'required|url',
        ];
    }
}
