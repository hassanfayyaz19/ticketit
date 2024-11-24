<?php

namespace Hassanfayyaz19\Ticketit\Models;

use Illuminate\Database\Eloquent\Model;
use Hassanfayyaz19\Ticketit\Traits\ContentEllipse;
use Hassanfayyaz19\Ticketit\Traits\Purifiable;

class Comment extends Model
{
    use ContentEllipse;
    use Purifiable;

    protected $table = 'ticketit_comments';

    /**
     * Get related ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('Hassanfayyaz19\Ticketit\Models\Ticket', 'ticket_id');
    }

    /**
     * Get comment owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
