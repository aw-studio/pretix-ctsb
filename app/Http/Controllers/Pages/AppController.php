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

        return Inertia::render('App', [
            'config' => $config,
            'event'  => $event,
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
