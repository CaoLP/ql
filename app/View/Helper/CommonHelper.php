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
                $class = 'danger';
                if(isset($data[$t]['total'])){
                    $total = $data[$t]['total'];
                    if($data[$t]['delay_time_begin'] == 0 && $data[$t]['delay_time_end'] == 0){
                        $class = '';
                    }
                    $time+=$data[$t]['total'];
                }
                if($link){
                    $result.='<'.$type.' class="'.$class.'">'.
                        $total .'</'.$type.'>';
                }else{
                    $result.='<'.$type.' class="'.$class.'">'.$total.'</'.$type.'>';
                }
                $begin = date ("Y-m-d", strtotime("+1 day", strtotime($begin)));
            }
        }
        return $result;
    }
    public function  formatMoney($input){
        return number_format($input, 0, '.', ',');
    }
}
