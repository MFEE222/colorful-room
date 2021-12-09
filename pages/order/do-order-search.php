<?php
include_once('../var.php');
include_once('../signin/do-authorize.php');
// ============================================================================
//  Test
// ============================================================================
echo post('order_search_keyword') . '<br>';
echo post('order_search_filter_time') . '<br>';
echo post('order_search_filter_status') . '<br>';
// ============================================================================
//  Feature
// ============================================================================
// 限制檔案抓取數量 Limit
// ============================================================================
//  Global Variable / Function
// ============================================================================
function post($name)
{
    if (isset($_POST[$name]) && !empty($_POST[$name]))
        return $_POST[$name];
    return $_POST[$name] = NULL;
}
function redirect($url)
{
    header("Location: $url");
    die();
}

// redirect($url_page_order_search . "?order_search_keyword=" . post('order_search_keyword') . "&order_search_filter_time=" . post('order_search_filter_time') . "&order_search_filter_status=" . post('order_search_filter_status'));
