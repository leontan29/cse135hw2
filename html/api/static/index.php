<?php
header("Content-Type: application/json");

require '../lib/db.php';

$method = $_SERVER['REQUEST_METHOD'];

// -----------------
// GET
if ($method == 'GET') {
  $id = $_GET['id'] ?? null;
  if (!$id) {
    // return all rows
    $rows = load();
    return respond(200, $rows);
  }
  
  $entry = find($id);
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
  insert($entry);
  return respond(200, '');
}

// -----------------
// DELETE
if ($method == 'DELETE') {
  $id = $_GET['id'] ?? null;
  if (!$id) {
    return respond(400, null);
  }

  delete($id);
  return respond(200, '');
}

// -----------------
// PUT
if ($method == 'PUT') {
  $id = $_GET['id'] ?? null;
  if (!$id) {
    return respond(400, null);
  }
  
  $entry = find($id);
  if (!$entry) {
    return respond(404, null);
  }

  $_PUT = [];
  parse_str(file_get_contents('php://input'), $_PUT);
  $obj = json_decode($_PUT['json'] ?? "{}", true);
  foreach ($obj as $key => $value) {
     $entry[$key] = $value;
  }
  if (!$entry) {
     return respond(400, '');
  }
  update($id, $entry);
  return respond(200, '');
}

// -----------------
// UNKNOWN METHOD
return respond(404, '');


?>
