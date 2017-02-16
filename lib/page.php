<?php
require_once '../include/include.php';

/*
* 得到分页数据
 * */
function getPageRows($limit,$sql)
{
//    $where=($where==null)?null:$where;

    //得到数据库中数据总条数
    $totalSql = $sql;
    $totalRows = getResultNum($totalSql);

//当前页码
    global $page;
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;


//总页数
    global $pageTotal;
    $pageTotal = ceil($totalRows / $limit);

//页码小于1，为空，不是数字时
    if ($page < 1 || $page == "" || !is_numeric($page)) {
        $page = 1;
    }
//页码超过总页码
    if ($page >= $pageTotal) {
        $page = $pageTotal;
    }

//开始位置
    $limitPage = ($page - 1) * $limit;

//分页语句
    $pageSql =" {$sql} LIMIT {$limitPage},{$limit} ";

//分页结果
    $pageRows = fetchAll($pageSql);
    return $pageRows;
}


/*显示分页按钮*/
function showPage($page, $pageTotal, $where)
{
    //增加条件
    $where=($where==null)?null:"&".$where;

    //当前url地址
    $url = $_SERVER['PHP_SELF'];
    //输出与页码
    $p = "";
    $index = ($page == 1) ? "<span class='disabled_page'>首页</span>" : "<a href='{$url}?page=1{$where}'>首页</a>";
    $last = ($page == $pageTotal) ? "<span class='disabled_page'>尾页</span>" : "<a href='{$url}?page=$pageTotal{$where}'>尾页</a>";
    $prev = ($page == 1) ? "<span class='disabled_page'>上一页</span>" : "<a href='{$url}?page=" . ($page - 1) . "{$where}'>上一页</a>";
    $next = ($page == $pageTotal) ? "<span class='disabled_page'>下一页</span>" : "<a href='{$url}?page=" . ($page + 1) . "{$where}'>下一页</a>";
    $cur = "<span>共{$pageTotal}页/第{$page}页</span>";
    //循环页码
    for ($i = 1; $i <= $pageTotal; $i++) {
        //点击的是当前页 当前页码无超链接
        if ($page == $i) {
            $p .= "<span class='page_num cur_page'> {$i}</span>";
        } else {
            $p .= "<a href='{$url}?page={$i}{$where}' class='page_num other_page'>{$i}</a>";
        }
    }
    //拼接页码
    $pageStr = $index . $prev . $p . $next . $last . $cur;
    return $pageStr;
}
