<?php

function db_find($tab, $id) {
  $rows = db_load($tab);
  foreach ($rows as $entry) {
    if ($id == $entry['id']) {
      return $entry;
    }
  }
  return null;
}

function db_insert($tab, $row) {
  $rows = db_load($tab);
  $maxid = 0;
  foreach ($rows as $rr) {
     if ($rr['id'] > $maxid) {
        $maxid = $rr['id'];
     }
  }
  $row['id'] = $maxid + 1;
  $rows[] = $row;
  save($rows);
  return $row['id'];
}

function db_update($tab, $id, $kval) {
  $entry = db_find($tab, $id);
  if (!$entry) {
     return false;
  }
  foreach ($kval as $key => $value) {
     $entry[$key] = $value;
  }
  db_delete($tab, $id);
  $rows = db_load($tab);
  $rows[] = $entry;
  save($rows);
  return true;
}
  

function db_delete($tab, $id) {
  $rows = db_load($tab);
  for ($idx = 0; $idx < count($rows); $idx++) {
    if ($id == $rows[$idx]['id']) {
      unset($rows[$idx]);
      save($rows);
      break;
    }
  }
  return true;
}

function db_load($tab) {
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
  return null;
}

?>