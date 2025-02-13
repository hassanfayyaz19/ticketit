<?php

namespace Hassanfayyaz19\Ticketit\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'ticketit_categories';

    protected $fillable = ['name', 'color'];

    /**
     * Indicates that this model should not be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get related tickets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('Hassanfayyaz19\Ticketit\Models\Ticket', 'category_id');
    }

    /**
     * Get related agents.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function agents()
    {
        return $this->belongsToMany('\Hassanfayyaz19\Ticketit\Models\Agent', 'ticketit_categories_users', 'category_id', 'user_id');
    }
}
