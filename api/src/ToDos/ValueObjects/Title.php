<?php

declare(strict_types=1);

namespace SoftwareEngineering\ToDos\ValueObjects;

use Funeralzone\ValueObjects\Scalars\StringTrait;
use Funeralzone\ValueObjects\ValueObject;

class Title implements ValueObject
{
    use StringTrait;
}
