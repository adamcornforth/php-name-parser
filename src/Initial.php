<?php


namespace AdamCornforth\PhpNameParser;


class Initial extends NamePart
{
    protected int $position = 1;
    protected string $direction = "right";

    /**
     * We only store the initial if it's 1 character and not a title.
     */
    public function isValid(string $value)
    {
        $isTitle = in_array($value, Title::titles);
        $length = strlen(str_replace(".", "", $value));

        return $length === 1 && !$isTitle;
    }

    public function setValue(string $value)
    {
        parent::setValue(str_replace(".", "", $value));
    }
}