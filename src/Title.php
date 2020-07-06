<?php


namespace AdamCornforth\PhpNameParser;


class Title extends NamePart
{
    protected bool $required = true;

    const titles = [
        "Mr",
        "Mrs",
        "Mister",
        "Dr",
        "Ms",
        "Prof"
    ];

    protected int $position = 0;

    public function isValid(string $value)
    {
        return in_array($value, self::titles);
    }
}