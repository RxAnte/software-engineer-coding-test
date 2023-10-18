<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\ValueObjects;

use Funeralzone\ValueObjects\Scalars\BooleanTrait;
use Funeralzone\ValueObjects\ValueObject;

class IsDone implements ValueObject
{
    use BooleanTrait;
}
