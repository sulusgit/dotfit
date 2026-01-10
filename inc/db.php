<?php
//writning func to  DB
@$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$con) {
    $error = mysqli_connect_errno();
    if ($error === 1049) {
        die('Your datebase not exists');
    } elseif ($error === 1045) {
        die('Users info not correct');
    } elseif ($error) {
        die('Something went wrong: ' . mysqli_connect_error());
    }
}

//using prep stmt get data from db:
// @@ name own func's with _ (np. _select)
//func only when it has parameters
function _select(&$stmt, &$count, $sql, $types, $sqlParams, &...$bindParams) // $sql is parametr
{
    global $con; // to use con inside this func

    $stmt = mysqli_prepare($con, $sql); //here using $con not possible i mean inside func so use upper global
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams); // ...$sqlParams is spreads the parametrs ... meands spread operator
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_bind_result($stmt, ...$bindParams);
}
//addition safty for select not forget fetch 
function _selectRow(&$stmt, &$count, $sql, $types, $sqlParams, &...$bindParams)
{
    _select($stmt, $count, $sql, $types, $sqlParams, ...$bindParams);
    _fetch($stmt);
}


//func without any paramters
function _selectAll(&$stmt, &$count, $sql, &...$bindParams) // $sql is parametr
{
    global $con; // to use con inside this func
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_bind_result($stmt, ...$bindParams);
}
function _fetch($stmt)
{
    return mysqli_stmt_fetch($stmt);
}
function _close_stmt($stmt) //clears data
{
    mysqli_stmt_close($stmt);
}
function _close()
{
    global $con;
    mysqli_close($con);
}
function _exec($sql, $types, $sqlParams, &$count)
{ //exec = ecequite
    global $con;
    //mysqli_report(MYSQLI_REPORT_ALL);
    $stmt = mysqli_prepare($con, $sql);
    //---
    if (!$stmt) {
        die("SQL prepare failed: " . mysqli_error($con));
    }
    //---
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    $success = mysqli_stmt_execute($stmt);
    $count = mysqli_stmt_affected_rows($stmt);
    _close_stmt($stmt);
    return $success;
}
