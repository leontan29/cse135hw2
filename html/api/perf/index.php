<?php
header("Content-Type: application/json");

require '../lib/helper.php';

$method = $_SERVER['REQUEST_METHOD'];

const TAB = 'perf';

// -----------------
// GET
if ($method == 'GET') {
  $id = $_GET['id'] ?? null;
  if (!$id) {
    // return all rows
    $rows = db_load(TAB);
    return respond(200, $rows);
  }
  
  $entry = db_find(TAB, $id);
  return respond($entry ? 200 : 204, $entry);
}

// -----------------
// POST
if ($method == 'POST') {
  $entry = [];
  $obj = json_decode($_POST['json'] ?? "{}", true);
  foreach ($obj as $key => $value) {
     $entry[$key] = $value;
  }
  if (!$entry) {
     return respond(400, '');
  }
  
  if (!db_insert(TAB, $entry)) {
     return respond(400, '');
  }
  
  return respond(200, '');
}

// -----------------
// DELETE
if ($method == 'DELETE') {
  $id = $_GET['id'] ?? null;
  if (!$id) {
    return respond(400, null);
  }

  if (!db_delete(TAB, $id)) {
     return respond(400, '');
  }
  
  return respond(200, '');
}

// -----------------
// PUT
if ($method == 'PUT') {
  $id = $_GET['id'] ?? null;
  if (!$id) {
    return respond(400, null);
  }
  
  $_PUT = [];
  parse_str(file_get_contents('php://input'), $_PUT);
  $kval = json_decode($_PUT['json'] ?? "{}", true);

  if (!db_update(TAB, $id, $kval)) {
     return respond(400, null);
  }

  return respond(200, '');
}

// -----------------
// UNKNOWN METHOD
return respond(404, '');


?>
