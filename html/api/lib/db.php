<?php

function find($id) {
  $rows = load();
  foreach ($rows as $entry) {
    if ($id == $entry['id']) {
      return $entry;
    }
  }
  return null;
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
  return null;
}

?>