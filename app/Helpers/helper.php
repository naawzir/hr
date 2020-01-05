<?php

function day($value) {
    if($value == 'Mon'){
        $value = 'M';
    }elseif($value == 'Tue'){
        $value = 'Tu';
    }elseif($value == 'Wed'){
        $value = 'W';
    }elseif($value == 'Thu'){
        $value = 'Th';
    }elseif($value == 'Fri'){
        $value = 'F';
    }elseif($value == 'Sat'){
        $value = 'Sa';
    }else{
        $value = 'Su';
    }
    return $value;
}

function findByUuid ($model, $uuid) {
    return $model->where('uuid', $uuid)->withTrashed()->firstOrFail();
}
