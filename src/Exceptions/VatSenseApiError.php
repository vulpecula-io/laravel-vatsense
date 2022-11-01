<?php

namespace Vulpecula\Vatsense\Exceptions;

use Exception;

final class VatSenseApiError extends Exception
{
    public static function get(string $query, $error): self
    {
        return new static("{$error['title']}: The query `{$query}` failed with error details: `{$error['details']}`.");
    }

    public static function invalidConfig(string $string): self
    {
        return new static("Invalid configuration. The key `{string}` is required.");
    }
}
