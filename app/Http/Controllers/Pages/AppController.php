<?php

namespace App\Http\Controllers\Pages;

use Inertia\Inertia;

class AppController
{
    public function __invoke(
        string $organizers,
        string $event,
        int $subevent = null,
    ) {
        if (empty(
            $config = $this->getConfig($organizers, $event)
        )) {
            abort(404);
        }
        if (! is_null($subevent)) {
            $config['subevent'] = $subevent;
        }

        $style = [
            'font'    => 'Inter',
            'primary' => [
                100       => '#ecf4ff',
                200       => '#d2d9f5',
                300       => '#6098ff',
                400       => '#5732a3',
                500       => '#4444af',
                600       => '#232378',
                'DEFAULT' => '#4444af',
            ],
            'secondary' => [
                500       => '#fba200',
                'DEFAULT' => '#fba200',
            ],
            'success' => [
                500       => '#03D079',
                'DEFAULT' => '#03D079',
            ],
            'danger' => [
                500       => '#FF3265',
                'DEFAULT' => '#FF3265',
            ],
        ];

        if (array_key_exists('style', $config)) {
            if (! is_null($config['style'])) {
                $style = $config['style'];
            }
        }

        $logo = null;
        if (array_key_exists('logo', $config)) {
            $logo = env($config['logo']);
        }

        $h1 = null;
        if (array_key_exists('h1', $config)) {
            $h1 = env($config['h1']);
        }

        return Inertia::render('App', [
            'config' => $config,
            'event'  => $event,
            'style'  => $style,
            'logo'   => $logo,
            'h1'     => $h1,
        ]);
    }

    public function upload(string $token)
    {
        if ($token != env('IMPORT_TOKEN')) {
            return redirect('/');
        }

        return Inertia::render('Import', [
            'token' => $token,
        ]);
    }

    /**
     * Get the event config.
     *
     * @param  string $organizers
     * @param  string $event
     * @return array
     */
    private function getConfig(string $organizers, string $event): array
    {
        $configs = collect(json_decode(env('CTSB_EVENTS'), true));

        foreach ($configs as $config) {
            if (
                $config['organizers'] == $organizers &&
                $config['event'] == $event
            ) {
                return $config;
            }
        }

        return [];
    }
}
