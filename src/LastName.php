<?php


namespace AdamCornforth\PhpNameParser;


class LastName extends NamePart
{
    protected int $position = 0;
    protected string $direction = "right";
    protected bool $required = true;

    /**
     * We only store the last name if it's not a title
     * and is longer than 1 character.
     */
    public function isValid(string $value)
    {
        $isTitle = in_array($value, Title::titles);
        $length = strlen(str_replace(".", "", $value));

        return $length > 1 && !$isTitle;
    }
}