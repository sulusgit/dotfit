<?php
//2. also count how much info fetched (using refrence)
/// update
/* $success = _exec(
    "update users set pass=? where id>?",
    'si', //this is types for parametrs
    ['89898989', 0], //sql parametrs inside array
    $count
); */
////delete
/* $success = _exec(
    "delete from users where id>?",
    'i', //this is types for parametrs
    [4], //sql parametrs inside array
    $count
); */
///insert
/* $success = _exec(
    "insert into users set name=?, pass=?",
    'ss', //this is types for parametrs
    ['Ganaa', 'pas3423'], //sql parametrs inside array
    $count
); */

//echo "Successfully updated $success, changed line nums: $count";

_select(
    $stmt,
    $count,
    "select ID, name, pass from users where id>?",
    'i',
    [0], // [$id, $pass],
    $col1,
    $col2,
    $col3 // col1 gets value for name, col2 for pass
);
_selectAll(
    $stmt,
    $count,
    "select id, name, pass from users",
    $col1,
    $col2,
    $col3 // col1 gets value for name, col2 for pass
);
echo "<br> num:  $count <br>";
while (_fetch($stmt)) {
    echo "<br>  $col1. $col2 ===> $col3";
}

_close_stmt($stmt);
_close();
