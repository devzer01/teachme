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
            $words[] = $message;
        } else {
            $words = explode(" ", $message);
        }

        return $words;
    }

}