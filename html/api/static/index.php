<?php
header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
  $id = 0;
  if (isset($_GET['id'])) {
     $id = $_GET['id'];
  }

  $contacts = load();
  if ($id) {
    $entry = find($id);
    if ($entry) {
      respond(200, $entry);
    } else {
      respond(204, NULL); // no data
    }
    return;
  } 

  // return all contacts
  respond(200, $contacts);
  return;
}


if ($method == 'POST') {
  $json = file_get_contents('php://input');
  $entry = json_decode($json, true);
  $contacts = load();
  $maxid = 0;
  foreach ($contacts as $c) {
     if ($c['id']) > $maxid) {
        $maxid = $c['id'];
     }
  }
  $entry['id'] = $maxid + 1;
  $contacts[] = $entry; // append
  save($contacts);
  respond(200, '');
  return;
}


function find($id) {
  $contacts = load();
  foreach ($contacts as $entry) {
    if ($id == $entry['id']) {
      return $entry;
    }
  }
  return false;
}


function load() {
  return json_decode(file_get_contents('./static.json', true), true);
}

function save($contacts) {
  $json = json_encode($contacts, JSON_PRETTY_PRINT);
  $file = fopen('static.json', 'w');
  fwrite($file, $json);
  fclose($file);
}

function respond($code, $data) {
  http_response_code($code);
  if ($data) {
    $msg =  json_encode($data, JSON_PRETTY_PRINT);
    echo $msg;
    error_log( print_r($msg, true));
  }
}

?>