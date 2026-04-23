<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestAccessNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $company,
        public readonly ?string $message,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Nova Solicitação de Acesso — Plannerate')
            ->greeting('Nova solicitação de acesso recebida.')
            ->line('**Nome:** '.$this->name)
            ->line('**E-mail:** '.$this->email);

        if ($this->company) {
            $mail->line('**Empresa:** '.$this->company);
        }

        if ($this->message) {
            $mail->line('**Mensagem:** '.$this->message);
        }

        return $mail->action('Responder por e-mail', 'mailto:'.$this->email)
            ->line('Acesse o painel para criar o acesso manualmente.');
    }
}
