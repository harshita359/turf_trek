<?php

require_once "db/config.php";

function selectAllData($table)
{
    $table = mysqli_real_escape_string($GLOBALS['conn'], $table); // Sanitize table name
    $select = "SELECT * FROM $table";
    $select_result = mysqli_query($GLOBALS['conn'], $select);
    return $select_result;
}

function selectAllDatabooking($table)
{
    $table = mysqli_real_escape_string($GLOBALS['conn'], $table); // Sanitize table name
    $select = "SELECT * FROM $table ORDER BY date ASC";
    $select_result = mysqli_query($GLOBALS['conn'], $select);
    return $select_result;
}

function selectDataByColumn($table, $column, $val)
{
    $table = mysqli_real_escape_string($GLOBALS['conn'], $table); // Sanitize table name
    $column = mysqli_real_escape_string($GLOBALS['conn'], $column); // Sanitize column name
    $val = mysqli_real_escape_string($GLOBALS['conn'], $val); // Sanitize value
    $select = "SELECT * FROM $table WHERE $column = '$val'";
    $select_result = mysqli_query($GLOBALS['conn'], $select);
    return mysqli_fetch_array($select_result, MYSQLI_ASSOC);
}

function selectDataByColumnnew($table, $column, $val)
{
    $table = mysqli_real_escape_string($GLOBALS['conn'], $table); // Sanitize table name
    $column = mysqli_real_escape_string($GLOBALS['conn'], $column); // Sanitize column name
    $val = mysqli_real_escape_string($GLOBALS['conn'], $val); // Sanitize value
    $select = "SELECT * FROM $table WHERE $column = '$val'";
    $select_result = mysqli_query($GLOBALS['conn'], $select);
    return $select_result;
}
function insert($data, $table)
{
    $table = mysqli_real_escape_string($GLOBALS['conn'], $table); // Sanitize table name
    $columns = implode(", ", array_keys($data));
    $values = implode(", ", array_map(function ($value) {
        return "'" . mysqli_real_escape_string($GLOBALS['conn'], $value) . "'";
    }, array_values($data)));

    $insert = "INSERT INTO $table ($columns) VALUES ($values)";
    if (mysqli_query($GLOBALS['conn'], $insert) or die(mysqli_error($GLOBALS['conn']))) {
        return mysqli_insert_id($GLOBALS['conn']);
    } else {
        echo "Error: " . $insert . "<br>" . $GLOBALS['conn']->error;
    }
}

function update($data, $table, $whereColumn, $whereValue)
{
    $table = mysqli_real_escape_string($GLOBALS['conn'], $table); // Sanitize table name
    $whereColumn = mysqli_real_escape_string($GLOBALS['conn'], $whereColumn); // Sanitize column name
    $whereValue = mysqli_real_escape_string($GLOBALS['conn'], $whereValue); // Sanitize value

    $updates = [];
    foreach ($data as $column => $value) {
        $column = mysqli_real_escape_string($GLOBALS['conn'], $column); // Sanitize column name
        $value = mysqli_real_escape_string($GLOBALS['conn'], $value); // Sanitize value
        $updates[] = "$column = '$value'";
    }
    $updateString = implode(", ", $updates);

    $update = "UPDATE $table SET $updateString WHERE $whereColumn = '$whereValue'";
    mysqli_query($GLOBALS['conn'], $update) or die(mysqli_error($GLOBALS['conn']));
    return true;
}

function deletedata($table, $column, $val)
{
    $table = mysqli_real_escape_string($GLOBALS['conn'], $table); // Sanitize table name
    $column = mysqli_real_escape_string($GLOBALS['conn'], $column); // Sanitize column name
    $val = mysqli_real_escape_string($GLOBALS['conn'], $val); // Sanitize value

    $delete = "DELETE FROM $table WHERE $column = '$val'";
    mysqli_query($GLOBALS['conn'], $delete) or die(mysqli_error($GLOBALS['conn']));
    return true;
}

