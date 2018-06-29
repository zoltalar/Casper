<?php

namespace App\Rules;

use App\Models\Event;
use Illuminate\Contracts\Validation\Rule;

class EventUserRule implements Rule
{
    protected $data = [];
    protected $userId;
    protected $event;
    protected $user;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->userId = array_get($this->data, 'user_id');
        $eventId = array_get($this->data, 'event_id');
        $this->event = Event::find($eventId);

        if ($this->event !== null) {
            $this->user = $this->event->user($this->userId);
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
            return 'Specified user is already invited to this event.';
        }

        return 'Specified user is already attending this event.';
    }
}
