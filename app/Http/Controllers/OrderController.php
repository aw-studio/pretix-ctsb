<?php

namespace App\Http\Controllers;

use Exception;
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
        
    }

    /**
     * Create a new order by posting a validated request to the the pretix-API.
     *
     * @param  Request $request
     * @return void
     */
    public function create(Request $request, string $event)
    {
        $this->setUrl($event);

        $validated = $request->validate([
            'email'                                       => 'required|confirmed|email',
            'email_confirmation'                          => 'required|email',
            'locale'                                      => 'required',
            'sales_channel'                               => 'required',
            'fees'                                        => 'required',
            'payment_provider'                            => 'required',
            'positions'                                   => 'required',
            'positions.*.subevent'                        => 'required',
            'positions.*.attendee_name_parts.given_name'  => 'required',
            'positions.*.attendee_name_parts.family_name' => 'required',
        ]);

        $response = $this->api->post($this->url, $validated);

        // Determine if the status code is >= 400...
        if ($response->failed()) {
            logger($response->body());
            throw new Exception('failed');
        }

        $this->resendMail($response->json()['code']);

        return Redirect::route('success', [
                'code' => $response->json()['positions'][0]['secret'],
                ])
                ->with([
                    'downloads' => $response->json()['downloads'],
                    'event' => $event
            ]);
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


    /**
     * Set the correct event.
     *
     * @param string $event
     * @return void
     */
    public function setUrl(string $event)
    {
        $this->url = config('pretix.api.url') . $event . '/orders/';
    }

}
