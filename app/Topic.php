<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Orderable;
class Topic extends Model
{
    use Orderable;
    protected $fillable=['title'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
