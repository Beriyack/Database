<?php
require_once './Database.php';

$db = new Database();

// SELECT
$results = $db->select("SELECT * FROM users");

// INSERT
$data = array('John', 'Doe', 'john@example.com');
$db->insert("INSERT INTO users (first_name, last_name, email) VALUES (?, ?, ?)", $data);

// UPDATE
$data = array('Jane', 'Doe', '1');
$db->update("UPDATE users SET first_name = ?, last_name = ? WHERE id = ?", $data);

// DELETE
$data = array('1');
$db->delete("DELETE FROM users WHERE id = ?", $data);