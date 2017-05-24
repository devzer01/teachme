<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 23/5/2560
 * Time: 2:56 น.
 */

class Ear {

    public function parse($message)
    {
        return $this->split($message);
    }

    protected function split($message)
    {
        $words = [];
        if (str_word_count($message) === 1) {
            $words[] = $this->sanatize($message);
        } else {
            $words = explode(" ", $message);
            $words = $this->bulkSanitize($words);
        }

        return $words;
    }

    public function bulkSanitize($words)
    {
        $clean = [];
        foreach ($words as $word) {
            $clean[] = $this->sanatize($word);
        }

        return $clean;
    }

    public function sanatize($word)
    {
        return preg_replace("/[^A-Za-z]+/", "", strtolower($word));
    }

}