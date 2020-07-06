<?php


namespace AdamCornforth\PhpNameParser;


use http\Exception\RuntimeException;

abstract class NamePart
{
    protected int $position;
    protected string $direction = "left";
    protected bool $required = false;

    protected ?string $value = null;

    /**
     * NamePart constructor.
     * @param string $fullname
     */
    public function __construct(string $fullname)
    {
        if (!isset($this->position)) {
            throw new \LogicException(get_class($this) . ' must have a $position');
        }

        $parts = explode(" ", $fullname);

        if ($this->direction === "right") {
            // Get the NamePart from the end side of the $parts array
            $this->position = count($parts) - $this->position - 1;
        }

        if (isset($parts[$this->position])) {
            if ($this->isValid($parts[$this->position])) {
                $this->setValue($parts[$this->position]);
            }
        }

        if ($this->required && !$this->getValue()) {
            throw new \RuntimeException(
                'Required NamePart ' . get_class($this) . ' not found in name: '.$fullname
            );
        }
    }

    /**
     * If this returns true, store the parsed value.
     *
     * @param string $value
     * @return bool
     */
    public function isValid(string $value) {
        return true;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue(string $value) {
        $this->value = $value;
    }
}