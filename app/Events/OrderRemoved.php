<?php

namespace App\Events;

use App\Order;
use App\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderRemoved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $patient_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, Patient $patient)
    {
        $this->order = $order;
        $this->patient_id = $patient->medical_record_number;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('orders.' . $this->patient_id);
    }

    public function broadcastWhen()
    {
        return !$this->order->patient()->exists();
    }
}
