<?php
namespace AdamCornforth\PhpNameParser;

class Parser
{
    /**
     * Return an array of fullname strings to parse from the homeowner field
     * @param string $homeowner
     * @return array
     */
    public function parseHomeowner(string $homeowner) : array
    {
        // Split the homeowner field into two names if needed
        $names = preg_split("/ (&|and) /", $homeowner);

        if (count($names) === 1) {
            return [
                $names[0]
            ];
        } else if (count($names) === 2) {
            // Add the name parts in the second person's name that aren't
            // in the first.
            $personOne = explode(" ", $names[0]);
            $personTwo = explode(" ", $names[1]);

            $personOne = array_merge(
                $personOne,
                array_slice($personTwo, count($personOne))
            );
            // Parse 2 names if supplied
            return [
                implode(" ", $personOne),
                implode(" ", $personTwo),
            ];
        } else {
            throw new \RuntimeException("Unsupported number of names in homeowner column value");
        }
    }

    /**
     * Parse a fullname string into its name parts
     *
     * @param string $string
     * @return Name
     */
    public function parseName(string $string) : Name
    {
        return new Name($string);
    }
}