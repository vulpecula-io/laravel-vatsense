<?php

namespace Vulpecula\Vatsense\Exceptions;

use Exception;

final class VatSenseCallFailed extends Exception
{
    public static function get(string $query, $error): self
    {
        return new static("{$error->title}: The query `{$query}` failed with error details: `{$error->details}`.");
    }
}
