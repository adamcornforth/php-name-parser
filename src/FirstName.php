<?php


namespace AdamCornforth\PhpNameParser;


class FirstName extends NamePart
{
    protected int $position = 1;
    protected string $direction = "right";

    /**
     * We only store the first name if it's longer than 1 character,
     * and is not a title.
     *
     * @param string $value
     * @return bool
     */
    public function isValid(string $value)
    {
        $isTitle = in_array($value, Title::titles);
        $length = strlen(str_replace(".", "", $value));

        return $length !== 1 && !$isTitle;
    }
}