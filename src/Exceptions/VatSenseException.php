<?php

namespace Vulpecula\Vatsense\Exceptions;

use Exception;

final class VatSenseException extends Exception
{
    public static function invalidConfig(string $string): self
    {
        return new self('Invalid configuration. The key `{string}` is required.');
    }
}
