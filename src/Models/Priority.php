<?php

namespace Hassanfayyaz19\Ticketit\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'ticketit_priorities';

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
        return $this->hasMany('Hassanfayyaz19\Ticketit\Models\Ticket', 'priority_id');
    }
}
