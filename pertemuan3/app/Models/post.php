<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model

{

use HasFactory;
 


protected $guarded = ['id'];
protected $with = ['author', 'category'];

    public function author(): BelongsTo
    {
        return $this->belongsTo (User::class, 'user_id');
}

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function category(): BelongsTo
    {
    return $this->belongsTo (Category::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function user()
    {
        return $this->belongsTo((User::class));
    }

}