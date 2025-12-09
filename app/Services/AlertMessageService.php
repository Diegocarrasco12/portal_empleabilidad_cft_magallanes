<?php

namespace App\Services;

class AlertMessageService
{
    public static function mensaje(string $accion)
    {
        $mensajes = [

            'APROBADA' => [
                'type' => 'success',
                'text' => '🎉 Tu oferta ha sido aprobada y ahora está visible para los postulantes.'
            ],

            'RECHAZADA' => [
                'type' => 'warning',
                'text' => '❌ La oferta fue rechazada. Revisa la retroalimentación y realiza las correcciones necesarias.'
            ],

            'ENVIADA' => [
                'type' => 'info',
                'text' => '📩 Tu oferta fue enviada para revisión. Estamos evaluando tu publicación.'
            ],

            'PAUSADA' => [
                'type' => 'info',
                'text' => '⏸ La oferta fue pausada y ya no está visible para postulantes.'
            ],

            'REACTIVADA' => [
                'type' => 'success',
                'text' => '🔄 La oferta fue reactivada correctamente y vuelve a estar disponible.'
            ],

            'CERRADA' => [
                'type' => 'error',
                'text' => '🔒 La oferta fue cerrada. Ya no recibirá nuevas postulaciones.'
            ]
        ];

        return $mensajes[$accion] ?? [
            'type' => 'info',
            'text' => 'Operación realizada correctamente.'
        ];
    }
}
