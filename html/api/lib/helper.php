<?php

const DBSERVER = 'localhost';
const DBUSER = 'leon';
const DBPASS = 'gugudog';
const DBNAME = 'cse135';

function db_connect() {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    return new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME);
}

function db_find($tab, $id) {
    $obj = null;
    $conn = db_connect();
    $stmt = $conn->prepare("select * from $tab where id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows) {
	$row = $result->fetch_assoc();
	$obj = [];
	foreach ($row as $key => $value) {
	    $obj[$key] = $value;
	}
    }
    $stmt->close();
    return $obj;
}

function db_insert($tab, $row) {
    $conn = db_connect();
    $field = [];
    $place = [];
    $data = [];
    $typ = '';
    foreach ($row as $key => $value) {
	$field[] = $key;
	$place[] = '?';
	$data[] = $value;
	$typ = $typ . 's';
    }
    $sql = "insert into $tab(" . implode(',', $field) . ') values (' .
	implode(',',$place) . ')';
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($typ, ...$data);
    $stmt->execute();
    $id = $conn->insert_id;
    $stmt->close();
    return $id;
}

function db_update($tab, $id, $kval) {
    $conn = db_connect();
    $field = [];
    $data = [];
    $typ = '';
    foreach ($kval as $key => $value) {
	$field[] = "$key=?";
	$data[] = $value;

	$typ = $typ . 's';
    }
    $sql = "update $tab set " . implode(',', $field) . ' where id=?';

    // for id...
    $typ = $typ . 's';
    $data[] = $id;

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($typ, ...$data);
    $stmt->execute();
    $affected_rows = $conn->affected_rows;
    $stmt->close();
    return $affected_rows == 1;
}

function db_delete($tab, $id) {
    $conn = db_connect();
    $sql = "delete from $tab where id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $affected_rows = $conn->affected_rows;
    $stmt->close();
    return true;
}

function db_load($tab) {
    $conn = db_connect();
    $sql = "select * from $tab";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $output = [];
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
	$obj = [];
	foreach ($row as $key => $value) {
	    $obj[$key] = $value;
	}
	$output[] = $obj;
    }
    $stmt->close();
    return $output;
}


// some tests 
if (false) {
    $row = ["mouse_x"=>10, "mouse_y" => 20];
    $id = db_insert('activity', $row);
    echo "id = $id\n";
    
    echo "all:\n";
    $all = db_load('activity');
    var_dump($all);
    
    
    echo "\none:\n";
    $row = db_find('activity', 1);
    var_dump($row);
}

    
?>
