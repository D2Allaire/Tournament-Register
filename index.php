<?php
require("config.php");

$action = explode('=', $_SERVER['QUERY_STRING'])[0];

switch ($action) {
    case 'region':
        viewRegion();
        break;
    case 'contact':
        contact();
        break;
    case 'submit':
        submit();
        break;
    default:
        homepage();
}

function viewRegion() {
    $region = $_GET['region'];
    $rid = 1;
    $rname = 'Europe';
    switch ($region) {
        case 'europe':
            $rid = 1;
            $rname = 'Europe';
            break;
        case 'northamerica':
            $rid = 2;
            $rname = 'North America';
            break;
        case 'australia':
            $rid = 3;
            $rname = 'Australia';
    }
    $results = array();
    $results['tournaments'] = Event::getList(100, 'tournaments', $rid);
    $results['leagues'] = Event::getList(100, 'leagues', $rid);
    $results['pageTitle'] = "Tournament Register - " . $rname;
    require(TEMPLATE_PATH . "/viewRegion.php");

}

function homepage() {
    $results = array();
    $results['pageTitle'] = "Tournament Register";
    require(TEMPLATE_PATH . "/homepage.php");
}

function contact() {
    $results = array();
    $results['pageTitle'] = "Tournament Register - Contact";
    require(TEMPLATE_PATH . "/contact.php");
}

function submit() {
    $results = array();
    $results['pageTitle'] = "Tournament Register - Submit";
    require(TEMPLATE_PATH . "/submit.php");
}