<?php
header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
error_log(print_r("method = $method", true));

// -----------------
// GET
if ($method == 'GET') {
  $id = 0;
  if (isset($_GET['id'])) {
     $id = $_GET['id'];
  }

  $rows = load();
  if (!$id) {
    // return all rows
    error_log(print_r($rows, true));
    return respond(200, $rows);
  }
  
  $entry = find($id);
  return respond($entry ? 200 : 204, $entry);
}

// -----------------
// POST
if ($method == 'POST') {
  error_log(print_r("in post", true));
  $entry = [];
  $obj = json_decode($_POST['json'], true);
  foreach ($obj as $key => $value) {
     $entry[$key] = $value;
  }
  insert($entry);
  return respond(200, '');
}

// -----------------
// DELETE
if ($method == 'DELETE') {
  $id = 0;
  if (isset($_GET['id'])) {
     $id = $_GET['id'];
  }

  if (!$id) {
    return respond(400, NULL);
  }

  delete($id);
  return respond(200, '');
}

// -----------------
// PUT
if ($method == 'PUT') {
  $id = 0;
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  if (!$id) {
    return respond(400, NULL);
  }
  
  $c = find($id);
  if (!$c) {
    return respond(404, NULL);
  }

  $_PUT = [];
  parse_str(file_get_contents('php://input'), $_PUT);
  $obj = json_decode($_PUT['json'], true);
  foreach ($obj as $key => $value) {
     $c[$key] = $value;
  }
  var_dump($c);
  update($id, $c);
  return respond(200, '');
}

// -----------------
// UNKNOWN METHOD
return respond(404, '');

/* ------------------------------------------------------- */

function find($id) {
  $rows = load();
  foreach ($rows as $entry) {
    if ($id == $entry['id']) {
      return $entry;
    }
  }
  return NULL;
}

function insert($c) {
  $rows = load();
  $maxid = 0;
  foreach ($rows as $rr) {
     if ($rr['id'] > $maxid) {
        $maxid = $rr['id'];
     }
  }
  $c['id'] = $maxid + 1;
  $rows[] = $c;
  save($rows);
  return $c['id'];
}

function update($id, $c) {
  delete($id);
  $rows = load();
  $rows[] = $c;
  save($rows);
}
  

function delete($id) {
  $rows = load();
  for ($idx = 0; $idx < count($rows); $idx++) {
    if ($id == $rows[$idx]['id']) {
      unset($rows[$idx]);
      save($rows);
      break;
    }
  }
}

function load() {
  $txt = file_get_contents('./static.json', true);
  $rows = json_decode($txt, true, JSON_UNESCAPED_SLASHES);
  return $rows;
}

function save($rows) {
  $json = json_encode($rows, JSON_PRETTY_PRINT);
  $file = fopen('./static.json', 'w');
  fwrite($file, $json);
  fclose($file);
}

function respond($code, $data) {
  http_response_code($code);
  if ($data) {
    $msg =  json_encode($data, JSON_PRETTY_PRINT);
    echo $msg;
  }
  return NULL;
}

?>
