<?php

namespace App\Http\Controllers\Pages;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Inertia\Inertia;

class SuccessController
{
    public function __invoke(string $code, string $event = null)
    {
        $options = new QROptions([
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]);

        // invoke a fresh QRCode instance
        $qrcode = new QRCode($options);

        // and dump the output
        return Inertia::render('Success', [
            'qr' => $qrcode->render($code),
            'code' => $code,
            'event' => $event,
        ]);
    }
}
