<?php

function get_query_strings()
{
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    return $queries;
}