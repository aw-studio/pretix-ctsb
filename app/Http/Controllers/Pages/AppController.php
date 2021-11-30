<?php

namespace App\Http\Controllers\Pages;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Inertia\Inertia;

class AppController
{
    public function __invoke(
        string $organizers,
        string $event,
        int $subevent,
    ) {
        if (! $config = $this->getConfig(
            $organizers,
            $event,
            $subevent,
        )) {
            dd('not found');
        }

        return Inertia::render('App', [
            'config' => $config,
        ]);
    }

    public function success(string $code)
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
        ]);
    }

    private function getConfig(
        string $organizers,
        string $event,
        int $subevent,
    ) {
        foreach (config('pretix.configs') as $config) {
            if (
                $config['organizers'] == $organizers &&
                $config['event'] == $event &&
                $config['subevent'] == $subevent
            ) {
                return $config;
            }
        }
    }
}
