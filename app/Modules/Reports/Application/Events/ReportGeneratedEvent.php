<?php

namespace App\Modules\Reports\Application\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReportGeneratedEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $url;

    /**
     * Create a new event instance.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('pdf-processing'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'ReportGeneratedEvent';
    }

    public function broadcastWith(): array
    {
        return [
            'fileUrl' => $this->url,
        ];
    }


    public function getUrl(): string
    {
        return $this->url;
    }
}
