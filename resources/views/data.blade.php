@php
$count = 0;
foreach ($data as $datas) {
    $myObj['data'][$count] = new stdClass();
    $count++;
}
foreach ($columns as $column) {
    $count = 0;
    foreach ($data as $datas) {
        $myObj['data'][$count]->$column = $datas[$column];
        $count++;
    }
}
$myJSON = json_encode($myObj);
echo $myJSON;
@endphp
