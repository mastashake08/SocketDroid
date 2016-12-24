<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'audio-upload',
        'post-gps',
        'post-battery',
        'image-upload',
        'post-texts',
        'add-device',
        'sms-send/*'

    ];
}
