<?php
/**
 * Created by PhpStorm.
 * User: LePhan
 * Date: 4/14/15
 * Time: 10:19 PM
 */

class CommonHelper extends AppHelper {

    public function createCalendarTable($date, $type = 'th', $data='', &$time = 0 , $link=false){
        $begin = date('Y-m-01',strtotime($date));
        $end = date('Y-m-t',strtotime($date));
        $result = '';
        if($type == 'th'){
            while (strtotime($begin) <= strtotime($end)) {
                $result.='<'.$type.'>'.(new DateTime($begin))->format('d').'</'.$type.'>';
                $begin = date ("Y-m-d", strtotime("+1 day", strtotime($begin)));
            }
        }else{
            while (strtotime($begin) <= strtotime($end)) {
                $t = strtotime($begin);
                $total = 0;
                $class = 'attendance-late';
                $t_begin = '';
                $t_late_b = 0;
                $t_end = '';
                $t_late_e = 0;
                if(isset($data[$t]['total'])){
                    $t_begin =  $data[$t]['begin_time'];
                    $t_late_b =  $data[$t]['delay_time_begin'];
                    $t_end =  $data[$t]['end_time'];
                    $t_late_e =  $data[$t]['delay_time_end'];
                    $total = $data[$t]['total'];
                    $total = $this->convertToHoursMins($total);
                    if($total > 0 && $data[$t]['delay_time_begin'] == 0 && $data[$t]['delay_time_end'] == 0){
                        $class = 'attendance-ok';
                    }
                    $time+=$data[$t]['total'];
                    if($data[$t]['type'] == 1) {
                        $class = 'error-begin';
                        $total = 'B';
                    }
                    if($data[$t]['type'] == 2) {
                        $class = 'error-end';
                        $total = 'E';
                    }
                }else{
                    $class="not-attendance";
                }
                $result.='<'.$type.' class="'.$class.'">';
                $result.= '<a class="btn btn-a"
                            href="#"
                            role="button"
                            data-placement="top"
                            data-toggle="popover"
                            data-html="true"
                            title="Thông tin điểm danh"
                            data-content="
                            <strong>Bắt đầu : </strong> <span>'.$t_begin.'</span> <br>
                            <strong>Đi trể : </strong> <span>'.$t_late_b.'</span> <br>
                            <strong>Kết thúc : </strong> <span>'.$t_end.'</span> <br>
                            <strong>Về sớm : </strong> <span>'.$t_late_e.'</span> <br>
                            ">';
                $result.= $total;
                $result.= '</a>';
                $result.='</'.$type.'>';
                $begin = date ("Y-m-d", strtotime("+1 day", strtotime($begin)));
            }
        }
        return $result;
    }
    public function  formatMoney($input){
        return number_format($input, 0, '.', ',');
    }
    public function convertToHoursMins($time, $format = '%d:%d') {
        settype($time, 'integer');
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
}
