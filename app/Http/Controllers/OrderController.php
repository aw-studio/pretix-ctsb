<?php

namespace App\Http\Controllers;

use App\Http\Resources\CtsbBookingResource;
use App\Imports\BookingImport;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

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
            'code'  => $response->json()['positions'][0]['secret'],
            'event' => $event,
        ])->with([
            'downloads' => $response->json()['downloads'],
        ]);
    }

    public function import(Request $request)
    {
        $this->setUrl('mobil4');

        $request->validate([
            'file' => 'required',
        ]);

        $bookings = (new BookingImport)->toArray($request->file);

        $list = [];

        foreach ($bookings as $booking) {
            $res = new CtsbBookingResource($booking[0]);

            $response = $this->api->post($this->url, $res->toArray($request));

            // Determine if the status code is >= 400...
            if ($response->failed()) {
                logger($response->body());

                throw new Exception('failed');
            }

            $options = new QROptions([
                'version'    => 5,
                'outputType' => QRCode::OUTPUT_MARKUP_SVG,
                'eccLevel'   => QRCode::ECC_L,
            ]);

            // invoke a fresh QRCode instance
            $qrcode = new QRCode($options);

            $list[] = [
                'given_name'  => $booking[0]['given_name'],
                'family_name' => $booking[0]['family_name'],
                'code'        => ($response->json()['positions'][0]['secret']),
                'qr'          => $qrcode->render($response->json()['positions'][0]['secret']),
            ];
        }

        return Inertia::render('List', [
            'list' => $list,
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
     * @param  string $event
     * @return void
     */
    public function setUrl(string $event)
    {
        $this->url = config('pretix.api.url').$event.'/orders/';
    }
}
