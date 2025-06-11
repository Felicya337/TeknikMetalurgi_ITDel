<?php

namespace App\Events;

use App\Models\UserInquiry;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewInquiryNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $inquiry;

    public function __construct(UserInquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function broadcastOn()
    {
        return new Channel('admin.inquiries');
    }

    public function broadcastWith()
    {
        return [
            'inquiry' => [
                'id' => $this->inquiry->id,
                'email' => $this->inquiry->email,
                'type' => $this->inquiry->type,
                'user_type' => $this->inquiry->user_type,
                'content' => $this->inquiry->content,
            ],
        ];
    }
}
