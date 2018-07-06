<?php

namespace App\Filters;

use App\Message;

class MessageFilters extends AbstractFilters
{
    protected function type($value)
    {
        if ($value === Message::INCOMING) {
            $this->builder->where(Message::INCOMING, true);
        } elseif ($value === Message::OUTGOING) {
            $this->builder->where(Message::INCOMING, false);
        }
    }

    protected function subscriber_id($value)
    {
        $this->builder->where('subscriber_id', $value);
    }
}
