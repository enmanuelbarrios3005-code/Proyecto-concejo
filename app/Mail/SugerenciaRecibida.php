<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SugerenciaRecibida extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;

    /**
     * Crea una nueva instancia del mensaje.
     */
    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    /**
     * Obtiene el sobre del mensaje.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Sugerencia Recibida',
        );
    }

    /**
     * Obtiene la definición del contenido del mensaje.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.sugerencia', // Usa la vista Markdown creada
            with: [
                'mensajeSugerencia' => $this->datos['mensaje'],
                // Agrega más datos si tu formulario los incluye
            ]
        );
    }

    /**
     * Obtiene los adjuntos para el mensaje.
     */
    public function attachments(): array
    {
        return [];
    }
}