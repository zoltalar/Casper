<?php

namespace App\Rules;

use App\Models\Event;
use Illuminate\Contracts\Validation\Rule;

class EventUserRule implements Rule
{
    protected $event;
    protected $user;
    protected $userId;

    public function __construct(array $data)
    {
        $eventId = array_get($data, 'event_id');
        $userId = array_get($data, 'user_id');

        $this->event = Event::find($eventId);

        if ($this->event !== null) {
            $this->user = $this->event->user($userId);
        }
    }

    public function passes($attribute, $value)
    {
        if ($this->event !== null) {
            return $this->event->user($this->userId) === null;
        }

        return false;
    }

    public function message()
    {
        $invited = false;

        if ($this->user !== null) {
            $invited = (bool) $this->user->pivot->invited;
        }

        if ($invited) {
            return 'The user is already invited to this event.';
        }

        return 'The user is already attending this event.';
    }
}
