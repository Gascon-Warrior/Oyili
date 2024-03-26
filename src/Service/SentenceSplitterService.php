<?php

namespace App\Service;

class SentenceSplitterService
{   
     /**
     * Découpe une phrase en morceaux de longueur maximale spécifiée.
     *
     * @param string $sentence La phrase à découper.
     * @param int $maxCaracteres La longueur maximale des morceaux de phrase.
     * @return array Un tableau contenant les morceaux de phrase découpés.
     */
    public function splitSentence(string $sentence, int $maxCharacters): array
    {
        $words = explode(" ", $sentence);
        $sentences = [];
        $currentSentence = '';

        foreach ($words as $word) {
            if (strlen($currentSentence . ' ' . $word) <= $maxCharacters) {
                $currentSentence .= ($currentSentence ? ' ' : '') . $word;
            } else {
                $sentences[] = $currentSentence;
                $currentSentence = $word;
            }
        }

        if (!empty($currentSentence)) {
            $sentences[] = $currentSentence;
        }

        return $sentences;
    }
}