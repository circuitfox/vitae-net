<?php

namespace App\Events;

use App\Lab;
use App\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LabRemoved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lab;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Lab $lab)
    {
        $this->lab = $lab;
    }

    public static function newWithPatient(Lab $lab, Patient $patient)
    {
        $event = new LabRemoved($lab);
        $event->patient_id = $patient->medical_record_number;
        return $event;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('lab.', $this->lab->patient->medical_record_number);
    }

    public function broadcastWhen()
    {
        return !$this->lab->patient()->exists();
    }
}
