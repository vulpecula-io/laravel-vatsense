<?php

namespace Vulpecula\Vatsense;

use Illuminate\Support\Facades\Http;
use Vulpecula\Vatsense\Exceptions\VatSenseCallFailed;

/**
 * Class Vatsense.
 */
class Vatsense
{
    /**
     * @var string
     */
    protected string $baseUrl = 'https://api.vatsense.com/1.0/';

    /**
     * Function get.
     *
     * @param  string  $endpoint
     * @param  array  $args
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    private function get(string $endpoint = 'rates', array $args = []): mixed
    {
        $response = Http::get($this->baseUrl.$endpoint, $args);

        if ($response->failed() === true) {
            // Todo: throw exception.

            $query = $endpoint.'?'.collect($args)->join('&');
            throw VatSenseCallFailed::get($query, $response->json('error'));
        }

        return $response->json('data');
    }

    /**
     * Function allRates.
     *
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    public function allRates(): mixed
    {
        return $this->get('rates');
    }

    /**
     * Function filterRates.
     *
     * @param  string|null  $country_code
     * @param  string|null  $ip_address
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    public function filterRates(?string $country_code, ?string $ip_address): mixed
    {
        return $this->get('rates/tax_rate', compact($country_code, $ip_address));
    }

    /**
     * Function allRateTypes.
     *
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    public function allRateTypes(): mixed
    {
        return $this->get('rates/types');
    }

    /**
     * Function findRate.
     *
     * @param  string|null  $country_code
     * @param  string|null  $ip_address
     * @param  bool|null  $eu
     * @param  string|null  $type
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    public function findRate(?string $country_code, ?string $ip_address, ?bool $eu, ?string $type): mixed
    {
        return $this->get('rates/tax_rate', compact($country_code, $ip_address, $eu, $type));
    }

    /**
     * Function quickRate.
     *
     * @param  string|null  $country_code
     * @param  string|null  $ip_address
     * @param  bool|null  $eu
     * @param  string|null  $type
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    public function quickRate(?string $country_code, ?string $ip_address, ?bool $eu, ?string $type): mixed
    {
        return $this->get('rates/rate', compact($country_code, $ip_address, $eu, $type));
    }

    /**
     * Function allCountries.
     *
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    public function allCountries(): mixed
    {
        return $this->get('countries');
    }

    /**
     * Function filterCountries.
     *
     * @param  string|null  $country_code
     * @param  string|null  $ip_address
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    public function filterCountries(?string $country_code, ?string $ip_address): mixed
    {
        return $this->get('countries', compact($country_code, $ip_address));
    }

    /**
     * Function validateVatNumber.
     *
     * @param  string  $vatNumber
     * @param  string|null  $requester
     * @return array|mixed
     *
     * @throws VatSenseCallFailed
     */
    public function validateVatNumber(string $vatNumber, ?string $requester): mixed
    {
        return $this->get('validate', compact($vatNumber, $requester));
    }
}
