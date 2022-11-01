<?php

namespace Vulpecula\Vatsense;

use Illuminate\Support\Facades\Http;
use Vulpecula\Vatsense\Exceptions\VatSenseApiError;
use Vulpecula\Vatsense\Exceptions\VatSenseException;

/**
 * Class Vatsense.
 */
class Vatsense
{
    /**
     * @var string
     */
    protected string $baseUrl = 'https://api.vatsense.com/1.0/';

    public function __construct()
    {
        if (is_null(config('vatsense.api_key'))) {
            throw VatSenseException::invalidConfig();
        }
    }

    /**
     * Function get.
     *
     * @param  string  $endpoint
     * @param  array  $args
     * @return array|mixed
     *
     * @throws VatSenseApiError
     */
    private function get(string $endpoint = 'rates', array $args = []): mixed
    {
        ray()->showHttpClientRequests();
        $response = Http::withBasicAuth('user', config('vatsense.api_key'))
            ->get($this->baseUrl.$endpoint, $args);

        if ($response->failed() === true) {
            $query = $endpoint.'?'.collect($args)->join('&');
            throw VatSenseApiError::get($query, $response->json('error'));
        }

        return $response->json('data');
    }

    /**
     * Function allRates.
     *
     * @return array|mixed
     *
     * @throws VatSenseApiError
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
     * @throws VatSenseApiError
     */
    public function filterRates(?string $country_code = null, ?string $ip_address = null): mixed
    {
        return $this->get('rates/tax_rate', compact('country_code', 'ip_address'));
    }

    /**
     * Function allRateTypes.
     *
     * @return array|mixed
     *
     * @throws VatSenseApiError
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
     * @throws VatSenseApiError
     */
    public function findRate(?string $country_code = null, ?string $ip_address = null, ?bool $eu = null, ?string $type = null): mixed
    {
        return $this->get('rates/tax_rate', compact('country_code', 'ip_address', 'eu', 'type'));
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
     * @throws VatSenseApiError
     */
    public function quickRate(?string $country_code = null, ?string $ip_address = null, ?bool $eu = null, ?string $type = null): mixed
    {
        return $this->get('rates/rate', compact('country_code', 'ip_address', 'eu', 'type'));
    }

    /**
     * Function allCountries.
     *
     * @return array|mixed
     *
     * @throws VatSenseApiError
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
     * @throws VatSenseApiError
     */
    public function filterCountries(?string $country_code = null, ?string $ip_address = null): mixed
    {
        return $this->get('countries', compact('country_code', 'ip_address'));
    }

    /**
     * Function validateVatNumber.
     *
     * @param  string  $vat_number
     * @param  string|null  $requester
     * @return array|mixed
     *
     * @throws VatSenseApiError
     */
    public function validateVatNumber(string $vat_number, ?string $requester = null): mixed
    {
        return $this->get('validate', compact('vat_number', 'requester'));
    }
}
