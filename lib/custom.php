<?php
/****************************************
Misc Theme Functions
 *****************************************/

function __t() { return get_template_directory_uri().'/'; }
function __a() { return __t().'assets/'; }
function __j() { echo __a().'js/'; }
function __i() { echo __a().'img/'; }
function __c() { echo __a().'css/'; }
function __v() { echo __a().'vendor/'; }
function __video() { echo __a().'video/'; }

function underscore($string) { return strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $string)); }

// categorie list
function get_cat_hierchy($parent,$args){
    $cats = get_categories($args);
    $ret = new stdClass;

    foreach($cats as $cat){
        if($cat->parent==$parent){
            $id = $cat->cat_ID;
            $ret->$id = $cat;
            $ret->$id->children = get_cat_hierchy($id,$args);
        }
    }

    return (array)$ret;
}

if(function_exists('acf_add_options_page')) {
    acf_add_options_page();
    acf_add_options_sub_page('General Settings');
}

function get_template_part_acf($slug, $name = null)
{
    $templates = array();
    $name = (string)$name;
    if ('' !== $name) {
        $templates[] = "{$slug}-{$name}.php";
    }

    $templates[] = "{$slug}.php";

    $located = '';
    foreach ((array)$templates as $template_name) {
        if (!$template_name) {
            continue;
        }
        if (file_exists(TEMPLATEPATH . '/' . $template_name)) {
            $located = TEMPLATEPATH . '/' . $template_name;
            break;
        }
    }

    return $located;
}
