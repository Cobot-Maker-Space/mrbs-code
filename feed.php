<?php
namespace MRBS;
require "defaultincludes.inc";
require "functions_ical.inc";
header("Content-Type: text/calendar");
$sql_params = array();
$sql = "SELECT E.*, "
     .  db()->syntax_timestamp_to_unix("E.timestamp") . " AS last_updated, "
     . "A.area_name, R.room_name, R.area_id, "
     . "A.approval_enabled, A.confirmation_enabled, A.enable_periods";

$sql .= ", T.rep_type, T.end_date, T.rep_opt, T.rep_interval, T.month_absolute, T.month_relative";

$sql .= " FROM " . _tbl('entry') . " E
     LEFT JOIN " . _tbl('room') . " R
            ON E.room_id = R.id
     LEFT JOIN " . _tbl('area') . " A
            ON R.area_id = A.id";

$sql .= " LEFT JOIN " . _tbl('repeat') . " T
                  ON E.repeat_id=T.id";

$sql .= " WHERE E.end_time > ?";
$sql_params[] = time();

if (array_key_exists('area', $_REQUEST)) {
  $sql .= ' AND R.room_name = ?';
  $sql_params[] = $_REQUEST['area'];
}

// We can't export periods in an iCalendar yet
$sql .= " AND A.enable_periods=0";

$sql .= " ORDER BY repeat_id, ical_recur_id";

$res = db()->query($sql, $sql_params);
$nmatch = $res->count();
export_icalendar($res, FALSE);
?>
