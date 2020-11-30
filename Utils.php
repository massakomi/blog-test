<?php

class Utils {

    /**
     * РЕДАКТИРОВАНИЕ УРЛА
     *
     * url('id=5') - добавит к текущему QUERY_STRING. в случае если уже есть id - заменит
     * url('id=5', 'id=10&mode=5') -
     */
    function url($add = '', $query = '')
    {
        $httpHost = 'http://'.$_SERVER['HTTP_HOST'];
        $path     = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        $query    = $query == '' ? $_SERVER['QUERY_STRING'] : $query;
        if ($query == '') {
            return $path.'?'.$add;
        }
        parse_str($query, $currentAssoc);
        parse_str($add, $addAssoc);
        if (is_array($addAssoc)) {
            foreach ($addAssoc as $k => $v) {
                $currentAssoc [$k]= $v;
            }
        }
        $a = array();
        foreach ($currentAssoc as $k => $v) {
            if ($v != '') {
            	$a []= "$k=$v";
            }
        }
        $add = implode('&', $a);
        return $path . ($add ? '?'.$add : $add);
    }

    function generatePagesLinks($limit, $start, $countAll, $floatLimit=50)
    {
        $pageLinks = '';
        $pageCount = ceil($countAll / $limit);
        if ($pageCount == 1) {
            return '';
        }
        $j = 0;
        if ($start > $floatLimit) {
            $pageLinks .= '<li class="page-item"><a class="page-link" href="'.Utils::url('start=').'">1...</a></li> ';
        }
        for ($i = max(1, $start - $floatLimit); $i <= $pageCount; $i ++) {
            if ($j > $floatLimit * 2) {
                break;
            }
            $st = '';
            if ($i - 1 == $start) {
                $st = ' active';
            }
            $num = $i - 1;
            if (!$num) {
            	$num = '';
            }
            $pageLinks .= '<li class="page-item'.$st.'"><a class="page-link" href="'.Utils::url('start='.$num).'">'.$i.'</a></li> ';
            $j ++;
        }
        if ($pageCount > $floatLimit * 2) {
            $pageLinks .= '<li class="page-item"><a class="page-link" href="'.Utils::url('start='.($pageCount - 1)).'"><span aria-hidden="true">&raquo;</span></a></li> ';
        }
        $pageLinks = '
            <nav aria-label="Page navigation">
              <ul class="pagination">
                '.$pageLinks.'
              </ul>
            </nav>
        ';
        return $pageLinks;
    }
}