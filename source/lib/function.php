<?php
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

function markdown_parse($content)
{
    require_once AppFile::lib('markdown' . DS . 'markdown');
    return Markdown(parse_inner_link($content));
}

function parse_inner_link($str)
{
    return preg_replace('/\[(.+?)\](?!\()/', '[$1]($1)', $str);
}
