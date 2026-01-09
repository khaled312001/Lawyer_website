<?php

namespace App\Enums;

enum SocialiteDriverType: string {
case GOOGLE = 'google';
case GOOGLE_ICON = 'client/images/google.svg';
case WHATSAPP = 'whatsapp';
case WHATSAPP_ICON = 'client/fontawesome-free/svgs/brands/whatsapp.svg';

    public static function getAll(): array {
        return [
            self::GOOGLE->value,
            self::WHATSAPP->value,
        ];
    }
}
