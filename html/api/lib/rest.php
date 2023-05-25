<?php

// do a REST operation on a table 
function REST($tab, $method, $GET, $POST) {

    // set our response content type
    header("Content-Type: application/json");

    // -----------------
    // GET
    if ($method == 'GET') {
	$id = $_GET['id'] ?? null;
	if (!$id) {
	    // return all rows
	    $rows = db_load($tab);
	    return respond(200, $rows);
	}
	
	$entry = db_find($tab, $id);
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
	
	if (!db_insert($tab, $entry)) {
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
	
	if (!db_delete($tab, $id)) {
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
	
	if (!db_update($tab, $id, $kval)) {
	    return respond(400, null);
	}
	
	return respond(200, '');
    }
    
    // -----------------
    // UNKNOWN METHOD
    return respond(404, '');
}


function respond($code, $data) {
  http_response_code($code);
  if ($data) {
    $msg =  json_encode($data, JSON_PRETTY_PRINT);
    echo $msg;
  }
  return null;
}

?>
