<?php
namespace AdamCornforth\PhpNameParser;

class Name
{
    private Title $title;
    private FirstName $first_name;
    private Initial $initial;
    private LastName $last_name;

    public function __construct(string $string)
    {
        $this->title = new Title($string);
        $this->first_name = new FirstName($string);
        $this->initial = new Initial($string);
        $this->last_name = new LastName($string);
    }

    public function toArray() {
        return [
            'title' => $this->title->getValue(),
            'first_name' => $this->first_name->getValue(),
            'initial' => $this->initial->getValue(),
            'last_name' => $this->last_name->getValue()
        ];
    }
}