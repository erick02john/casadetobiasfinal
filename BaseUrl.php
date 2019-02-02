<?php
if (!function_exists('base_url')) {
    function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $base_url = 'http://localhost/casadetobiasfinal/';
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}

if (! function_exists('formatnumber2')) {
    function formatnumber2($number) {
        $number = number_format($number, 2, '.', ',');
        return $number;
    }
}

if (! function_exists('currentdate')) {

    function currentdate() {
      //$differencetolocaltime=-8;
      $differencetolocaltime=-6;
      $new_U=date("U")-$differencetolocaltime*3600;
      $today = date("M d, Y", $new_U);
      return $today;
    }
}

if (! function_exists('currentdate1')) {

    function currentdate1() {
      //$differencetolocaltime=-8;
      $differencetolocaltime=-6;
      $new_U=date("U")-$differencetolocaltime*3600;
      $today = date("Y m, d", $new_U);
      return $today;
    }
}


if (! function_exists('currentdate3')) {
    function currentdate3() {
    $differencetolocaltime=-8;
    $new_U=date("U")-$differencetolocaltime*3600;
    $today = date("Y-m-d", $new_U);
    return $today;
    }
}


if (! function_exists('currentdatetime')) {

    function currentdatetime() {
      //$differencetolocaltime=-8;
      $differencetolocaltime=-6;
      $new_U=date("U")-$differencetolocaltime*3600;
      $today = date("Y-m-d H:i:s", $new_U);
      return $today;
    }
}

if (! function_exists('formatdate')) {
    function formatdate($date) {
    $newDate = date("Y-n-j", strtotime($date));
    return $newDate;
    }
}


if (! function_exists('formatdate1')) {

    function formatdate1($date) {
    $newDate = date("n-j-Y", strtotime($date));
    return $newDate;
    }
}

if (! function_exists('formatdate2')) {

    function formatdate2($date) {
    $newDate = date("m/d/Y", strtotime($date));
    return $newDate;
    }
}

if (! function_exists('formatdate3')) {
    function formatdate3($date) {
    $newDate = date("Y-m-d", strtotime($date));
    return $newDate;
    }
}

if (! function_exists('redirect')) {
  function redirect($url) {
    ?>
    <script type="text/javascript">
     document.location.href = '<?=$url;?>';
     </script>
     <?php
  }

}


if (! function_exists('datediff')) {
    function datediff($start, $end){
    $dates = array($start);
    while(end($dates) < $end){
        $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
    }
    return $dates;
}
}

if (! function_exists('datebetween')) {
function datebetween($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('n-d-Y',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('n-d-Y',$iDateFrom));
        }
    }
    return $aryRange;
}
}
