<?php
// Routes

require_once "Concept.php";
require_once "Template.php";
require_once "Sense.php";
require_once "Word.php";
require_once "Host.php";

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->post('/concept', function($req, $res, $args) {
    $concept = new Concept();
    $concept->setAll($req->getParsedBody()['data']);
    $id = $concept->entry();
    return $res->withJson(['id' => $id], 200);
});

$app->post('/incomming', function ($req, $res, $params) {
    $host = new Host();
    $host->incoming($req->getParsedBody()['data']);
    $reply = ['learn' => 0];

    if ($host->learning()) {
        $host->digest();
    }

    if ($host->think()) {
        if ($host->opinion()) { //basis for opinion here
            $reply['msg'] = $host->give()['phrase'];
        } else if($host->heardof()) { //existing idea or opinion expansion
            $reply['msg'] = "i have heard of it, but i do not know about it. Care to tell me about it?"; //based on the tree
            $reply['learn'] = 1;
            $reply['context'] = $host->about();
        } else {
            if ($host->curious()) {
                $reply['msg'] = "what's the use of it?"; //use for lack of a better word (back of a letter word)
                $reply['learn'] = 1;
            } else {
                $reply['msg'] = "i don't know about it, can you tell me more?";
                $reply['learn'] = 1;
            }
        }
    }

    if ($reply['msg'] === null) $reply['msg'] = "i am too busy to think today, maybe you can tell me another time";
    $reply['debug'] = $host->debug();
    $reply['learn'] = 1;
    return $res->withJson($reply, 200);
});

$app->post('/words/{concept_id}', function($req, $res, $args) {
    $word = new Word();
    $words = $req->getParsedBody()['data'];
    $ids = [];
    foreach ($words as $w) {
        $word->setAll($w);
        $ids[] = $word->entry();
    }

    print_r($args);

    $concept = new Concept();
    $concept->assoc($args['concept_id'], $ids);
    return $res->withJson($ids, 200);
});


$app->get('/concept', function ($request, $response, $args) use ($app) {
    $concept = new Concept();
    $records = $concept->all();
    return $response->withJson($records, 200);
});

$app->get('/word', function ($request, $response, $args) use ($app) {
    $word = new Word();
    $records = $word->all();
    return $response->withJson($records, 200);
});

$app->get('/sense', function ($request, $response, $args) use ($app) {
    $sense = new Sense();
    $records = $sense->all();
    return $response->withJson($records, 200);
});

$app->get('/template', function ($request, $response, $args) {
    $template = new Template();
    $records = $template->all();
    return $response->withJson($records, 200);
});