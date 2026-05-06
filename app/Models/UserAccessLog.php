<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccessLog extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'device',
        'browser',
        'platform',
        'location',
        'event',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Parse device info from user agent string.
     */
    public static function parseUserAgent(string $userAgent): array
    {
        $device   = 'desktop';
        $browser  = 'Desconhecido';
        $platform = 'Desconhecido';

        // Platform detection
        if (str_contains($userAgent, 'Windows'))       $platform = 'Windows';
        elseif (str_contains($userAgent, 'Macintosh')) $platform = 'macOS';
        elseif (str_contains($userAgent, 'Linux'))     $platform = 'Linux';
        elseif (str_contains($userAgent, 'Android'))   $platform = 'Android';
        elseif (str_contains($userAgent, 'iPhone'))    $platform = 'iOS';
        elseif (str_contains($userAgent, 'iPad'))      $platform = 'iPadOS';

        // Device detection
        if (str_contains($userAgent, 'Mobi') || str_contains($userAgent, 'Android')) {
            $device = 'mobile';
        } elseif (str_contains($userAgent, 'iPad') || str_contains($userAgent, 'Tablet')) {
            $device = 'tablet';
        }

        // Browser detection
        if (str_contains($userAgent, 'Edg/'))          $browser = 'Edge';
        elseif (str_contains($userAgent, 'OPR/'))      $browser = 'Opera';
        elseif (str_contains($userAgent, 'Firefox/'))  $browser = 'Firefox';
        elseif (str_contains($userAgent, 'Chrome/'))   $browser = 'Chrome';
        elseif (str_contains($userAgent, 'Safari/'))   $browser = 'Safari';

        return compact('device', 'browser', 'platform');
    }

    /**
     * Log a login event for the given user.
     */
    public static function logLogin(User $user, string $ipAddress, string $userAgent, string $event = 'login'): self
    {
        $parsed = self::parseUserAgent($userAgent);

        return self::create([
            'user_id'    => $user->id,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'device'     => $parsed['device'],
            'browser'    => $parsed['browser'],
            'platform'   => $parsed['platform'],
            'location'   => null, // pode ser enriquecido por um job com GeoIP
            'event'      => $event,
        ]);
    }
}
