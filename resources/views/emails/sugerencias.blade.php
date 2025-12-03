<x-mail::message>
# Nueva Sugerencia de Usuario

Has recibido una nueva sugerencia a través del buzón:

<x-mail::panel>
"{{ $mensajeSugerencia }}"
</x-mail::panel>

Gracias,
{{ config('app.name') }}
</x-mail::message>