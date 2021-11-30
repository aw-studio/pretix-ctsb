<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class OrderController
{
    /**
     * API client.
     *
     * @var string
     */
    protected $api;

    /**
     * API base-url.
     *
     * @var string
     */
    protected $url;

    /**
     * Create a new OrderController instance.
     */
    public function __construct()
    {
        $this->api = Http::withHeaders([
            'Authorization' => 'Token '.config('pretix.api.token'),
            'Content-Type'  => 'application/json',
        ]);
        $this->url = config('pretix.api.url');
    }

    /**
     * Create a new order by posting a valid request to the the pretix-API.
     *
     * @param  Request $request
     * @return void
     */
    public function create(Request $request)
    {
        // $validated = $request->validate([

        // ]);

        $response = $this->api->post($this->url, $request->all());

        // Determine if the status code is >= 400...
        if ($response->failed()) {
            // TODO:
        }

        $this->resendMail($response->body()['code']);

        return Redirect::route('home');
    }

    /**
     * Trigger resend mail.
     *
     * @param  string $code
     * @return void
     */
    public function resendMail(string $code): void
    {
        // TODO: check response?
        $this->api->post($this->url.$code.'/resend_link/');
    }
}
