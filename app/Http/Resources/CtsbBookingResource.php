<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CtsbBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request                                        $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'email'              => $this->resource['email'], // <- this
            'email_confirmation' => $this->resource['email'], // <- this
            'locale'             => 'de',
            'sales_channel'      => 'web',
            'fees'               => [
                [
                    'fee_type'      => 'payment',
                    'value'         => '0.0',
                    'description'   => 'a',
                    'internal_type' => 'a',
                    'tax_rule'      => $this->resource['tax_rule'], // <- this
                ],
            ],
            'payment_provider' => 'free',
            'positions'        => [
                [
                    'positionid'          => 1,
                    'item'                => $this->resource['item'], // <- this
                    'variation'           => null,
                    'price'               => '0.00',
                    'attendee_name_parts' => [
                        '_scheme'     => 'given_family',
                        'given_name'  => $this->resource['given_name'], // <- this
                        'family_name' => $this->resource['family_name'], // <- this
                    ],
                    'attendee_email' => $this->resource['email'], // <- this
                    'addon_to'       => null,
                    'answers'        => [
                        [
                            'answer'              => $this->resource['street_no'],
                            'option_identifiers'  => [],
                            'options'             => [],
                            'question'            => 39590,
                            'question_identifier' => 'street-no',
                        ],
                        [
                            'answer'              => $this->resource['zip_city'],
                            'option_identifiers'  => [],
                            'options'             => [],
                            'question'            => 39591,
                            'question_identifier' => 'zip-city',
                        ],
                        [
                            'answer'              => Carbon::parse($this->resource['birthdate'])->format('Y-m-d'),
                            'option_identifiers'  => [],
                            'options'             => [],
                            'question'            => 39592,
                            'question_identifier' => 'birthdate',
                        ],
                        [
                            'answer'              => $this->resource['phone'],
                            'option_identifiers'  => [],
                            'options'             => [],
                            'question'            => 39593,
                            'question_identifier' => 'phone',
                        ],
                        [
                            'answer'              => $this->resource['pass_id'] ?: 'a',
                            'option_identifiers'  => [],
                            'options'             => [],
                            'question'            => 39595,
                            'question_identifier' => 'pass-id',
                        ],
                        [
                            'answer'              => $this->resource['consent'],
                            'option_identifiers'  => [],
                            'options'             => [],
                            'question'            => 39596,
                            'question_identifier' => 'consent',
                        ],
                        [
                            'answer'              => $this->resource['consent_cwa_pseudo'],
                            'option_identifiers'  => [],
                            'options'             => [],
                            'question'            => 39597,
                            'question_identifier' => 'consent-cwa-pseudo',
                        ],
                        [
                            'answer'              => $this->resource['consent_cwa_name'],
                            'option_identifiers'  => [],
                            'options'             => [],
                            'question'            => 39598,
                            'question_identifier' => 'consent-cwa-name',
                        ],

                    ], // <- this
                    'subevent' => $this->resource['subevent'], // <- this
                ],
            ],
        ];
    }
}
