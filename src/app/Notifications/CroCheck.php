<?php

namespace App\Notifications;

use App\Dentist;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class CroCheck extends Notification implements ShouldQueue
{
    use Queueable;

    protected $dentist;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Dentist $dentist)
    {
        $this->dentist = $dentist;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        switch ($this->dentist->cro_status) {
            case 'A':
                $title = 'CRO aprovado';
                $message = ["Dentista: {$this->dentist->name}"];
                break;
            case 'R':
                $title = 'CRO rejeitado';
                $message = [
                    "Dentista: {$this->dentist->name}",
                    "Motivo: {$this->dentist->cro_status_message}",
                ];
                break;
            case 'E':
                $title = 'Erro ao verificar CRO';
                $message = [
                    "Dentista: {$this->dentist->name}",
                    "Motivo: {$this->dentist->cro_status_message}",
                ];
                break;
            default:
                return [];
        }

        return [
            'title' => $title,
            'message' => $message ?? '',
            'route' => route('dentists', ['q' => $this->dentist->cro])
        ];
    }
}
