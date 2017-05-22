<?php
/**
 * Created by PhpStorm.
 * User: nayana
 * Date: 20/5/2560
 * Time: 6:07 น.
 */

require_once 'db.php';

class Host extends Db {

    public $take = "";

    public $table = 'concept';

    const INTENTION = 17; //hetuwa
    const NOUN = 18;
    const VERB = 19;
    const RESULT = 21;

    protected $dimensions = [];

    protected $filters = ['to', 'am'];

    public function __construct()
    {
        parent::__construct();
        parent::init();
    }

    public function meaning($word)
    {
        $sql = "SELECT c.id AS concept_id, c.name AS concept_name, "
             . "c.parent_id, c.template_id, t.name AS template, "
             . "receive_template_id, give_template_id, observe_template_id "
             . "FROM concept AS c "
             . "LEFT JOIN template AS t ON t.id = c.template_id "
             . "WHERE c.name LIKE :word ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':word' => $word ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function wm($word)
    {
        $sql = "SELECT w.id, w.word, wc.concept_id "
             . "FROM word AS w "
             . "JOIN word_concept AS wc ON wc.word_id = w.id "
             . "WHERE w.word LIKE :word ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':word' => $word . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function parse($message)
    {
        $words = $this->wordSplit($message);
        $filters = $this->filters;

        return array_filter($words, function($v) use ($filters) {
            return !(in_array($v, $filters));
        });
    }

    protected function wordSplit($message)
    {
        $words = [];
        if (str_word_count($message) === 1) {
            $words[] = $message;
        } else {
            $words = explode(" ", $message);
        }

        return $words;
    }

    public function cognition($words)
    {
        if (count($words) === 0) throw new Exception("empty");

        $concepts = [];
        foreach ($words as $word) {
            $res = $this->meaning($word);
            if (!empty($res)) $concepts[$word] = $res;
            else $concepts[$word] = 0;
        }

        return $concepts;
    }

    public function conceptualize($concepts) {

        $dimensions = [];

        foreach ($concepts as $concept) {

            $pc = ($concept['receive_template_id'] === 0) ? $concept['concept_id'] : $concept['receive_template_id'];

            $dimensions[$pc][] = [
                'concept_id' => $concept['concept_id'],
                'template' => $concept['template'],
                'concept_name' => $concept['concept_name']
            ];
        }

        return $dimensions;
    }

    public function understanding($words, $concepts, $dimensions) {
        $total = count($words);
        $index = 0;
        $unit = ['score' => 50, 'word' => [], 'value' => 0];
        $intention = [[$unit,$unit,$unit], [$unit,$unit,$unit]]; //me, sender, others ඉල්ලීමක් දගැනීමක් vicharaya
        foreach ($words as $word) {
            $concept = $concepts[$word];
            $value = ($total - $index) / $total;
            $pc = ($concept['receive_template_id'] === 0) ? $concept['concept_id'] : $concept['receive_template_id'];
            $intention = $this->estimation($intention, $word, $pc, $value);
        }
        return $intention;
    }

    public function estimation($x, $w, $c, $v) {
        switch ($c) {
            case 22: //self
                $x[0][0]['score']++;
                $x[0][0]['word'][] = ['key' => $w, 'value' => $v];
                break;
            case 23: //sender
                $x[0][1]['score']++;
                $x[0][1]['word'][] = ['key' => $w, 'value' => $v];
                break;
            case 24: //observer
                $x[0][2]['score']++;
                $x[0][2]['word'][] = ['key' => $w, 'value' => $v];
                break;
            case 25: //give
                $x[1][0]['score']++;
                $x[1][0]['word'][] = ['key' => $w, 'value' => $v];
                break;
            case 26: //take
                $x[1][1]['score']++;
                $x[1][1]['word'][] = ['key' => $w, 'value' => $v];
                break;
            case 27: //expression (feeling, describe)
                $x[1][1]['score']++;
                $x[1][1]['word'][] = ['key' => $w, 'value' => $v];
                break;
        }
        return $x;
    }

    public function estimator2($sentence)
    {
        $words = $this->wordSplit($sentence);
        $iut = 0;
        $gre = 0;
        foreach ($words as $word) {
            $gre = $this->gre($word);
            $iot = $this->iot($word);
        }
    }

    //give receive express
    protected function gre($word)
    {
        $map = [
            'int' => 0, //intention
            'giv' => 1, //giving
            'tak' => 2, //take
            'obs' => 3, //observation
            'fil' => 4 //feeling
        ];

        $exp = 13; $sent = 14;

        $view = "0.0.0";

        if (in_array($word, array_keys($map))) {

        }
    }

    protected function iut($word)
    {
        $map = ['i' => 0, 'you' => 1, 'they' => 2 ];
        if (in_array($word, array_keys($map))) {

        }
    }

    public function digest() {
        $sql = "INSERT INTO matter (concept_id, text, saidso) "
             . "VALUE (:id, :text, :who)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $this->context, ':text' => $this->msg, ':who' => 'unknown']);
    }

    public function heardof()
    {
        return $this->understanding && count($this->potential) === 0;
    }

    public function recognize($take)
    {
        $bits = $this->conceptualize($take);
        $concepts = $this->cognition($bits);
        return count($this->concepts) > 0;
    }






    /**
     * @return null
     */
    public function understand()
    {
        $this->understanding = $this->research();
        return (count($this->understanding) > 0);
    }

    public function think()
    {
        if ($this->recognize()) {
            $this->perception = $this->concepts[0];
        } else if ($this->understand()) {
            $this->perception = $this->understanding;
        }
        return ($this->perception !== null);
    }

    public function about() {
        return $this->perception['id'];
    }

    //desire to learn more,
    //in a system there is no organic feelings
    //we must use some form of random number generator
    //to assume certain aspect of life that can't be
    //represented in a mathematical form
    //assume each byte represents energy adjustment on a meta-physical body
    //and we use 100(hex) as middle position
    ////mass energy index
    public function curious()
    {
        $bytes = random_bytes(9); //ideally should be a representation of moment (1 energy source, 8 objects defining that in 1 place)
        return (rand(1, 9) > 3);
        /*//planetary energy representation
        //8 rotating celestial bodies working on a 9 planet planetary system
        //singularity at b
        $theory = [decbin(1), decbin(2), decbin(3), decbin(4), decbin(5), decbin(6), decbin(7), decbin(8), decbin(9)];
        for ($i=0; strlen($bytes); $i++) {
            echo bin2hex($bytes[$i]) . " - ";
            echo $theory[$i]  . " - ";
            echo bin2hex($theory[$i] ^ $bytes[$i])  . "\n";
            /*if ($theory[$i] ^ $bytes[$i]) {
            }*/
        //}
        //echo bin2hex($bytes);
        /*for ($i=0; $i < count($bytes); $i++) {
            if ($rep[$i] ^ $pxi == '') {
                echo bin2hex($rep[$i]) . "\n";
                $cxi += 1;
            }
        }
        echo $cxi;*/
        /*return $cxi;*/
    }

    /*
     *
     * form opinion
     */
    public function opinion()
    {
        $sql = "SELECT phrase FROM opinion WHERE concept_id = :id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $this->understanding['id']]);
        $this->potential = $stmt->fetchAll();
        if (count($this->potential) > 0) {
            return true;
        }

        return false;

        //$this->understanding['opinion_id'] !== 0);
        //concept eka gana tiyana mataya
        //matayak nethnam api eya gana hadariimak kala hakiya
        //ema hadariii ta sadaka wanney uma concept eka gana darana matha mathai
        //dna trait curiosity
    }

    /**
     * @return mixed$sql = "SELECT * FROM opinion WHERE concept_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':id' => $this->understanding['id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
     */

    public function give()
    {
        return $this->potential[0];
    }

    public function research()
    {
        require_once 'Word.php';
        require_once 'Concept.php';
        $word = new Word();
        return $word->conceptByRef($this->msg);
    }

    public function debug()
    {
        return [
            'concepts' => $this->concepts,
            'research' => $this->information,
            'understanding' => $this->understanding,
            'potential' => $this->potential
        ];
    }
}