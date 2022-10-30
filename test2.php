<?php

function run($offset, $text)
{
    return (new OffsetEncodingAlgorithm((int)$offset, $text))->encode();
}


class OffsetEncodingAlgorithm
{
    public const CHARACTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public int $offset;
    public string $text;

    public function __construct(int $offset, string $text)
    {
        $this->offset = $offset;
        $this->text = $text;
        $this->characters = self::CHARACTERS;
    }

    public function encode(): string
    {
        if ($this->offsite < 0) {
            return 'N/A';
        }

        $characters = str_split($this->characters);
        $textSplit = str_split($this->text);

        $string = '';
        $b = 0;
        for ($i = $this->offset, $iMax = count($textSplit); $i <= $iMax; $i++) {
            if (preg_match('/[\'^£$%&*()}{@#~?><>,.|=_+¬- ]/', $this->text[$i - 1])) {
                $string .= $this->text[$i - 1];
                $b = 1;
            } elseif (!empty($b)) {
                $string .= $characters[$i - 1];
                $b=0;
            } else {
                $string .= $characters[$i];
            }
        }

        return $string;
    }
}
