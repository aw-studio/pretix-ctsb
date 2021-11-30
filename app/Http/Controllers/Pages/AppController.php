<?php

namespace App\Http\Controllers\Pages;

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
