<?php
require("config.php");

$time = $_SERVER['REQUEST_TIME'];

// Session timeout value: 30 minutes
$timeout_duration = 1800;

/**
 * Here we look for the user’s LAST_ACTIVITY timestamp. If
 * it’s set and indicates our $timeout_duration has passed,
 * blow away any previous $_SESSION data and start a new one.
 */
if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}

/**
 * Finally, update LAST_ACTIVITY so that our timeout
 * is based on it and not the user’s login time.
 */
$_SESSION['LAST_ACTIVITY'] = $time;

session_start();
$action = explode('=', $_SERVER['QUERY_STRING'])[0];
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
    login();
    exit;
}

switch ($action) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'region':
        editRegions();
        break;
    case 'editTournament':
        editTournament();
        break;
    case 'editLeague':
        editLeague();
        break;
    case 'editSubmission':
        editSubmission();
        break;
    case 'createTournament':
        createTournament();
        break;
    case 'createLeague':
        createLeague();
        break;
    case 'delete':
        deleteEvent();
        break;
    default:
        dashboard();
}

function login() {
    $results = array();
    $results['pageTitle'] = "Admin Login";
    if ( isset( $_POST['login'] ) ) {

        // User has filled login form, try to login
        if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {

            // Login successful
            $_SESSION['username'] = ADMIN_USERNAME;
            header( "Location: admin.php" );

        } else {

            // Login failed
            $results['errorMessage'] = "Incorrect username or password. Please try again.";
            require( TEMPLATE_PATH . "/admin/loginForm.php" );
        }

    } else {

        // User has not posted the login form yet: display the form
        require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

}


function logout() {
    unset( $_SESSION['username'] );
    header( "Location: admin.php" );
}


function editRegions() {
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
    require(TEMPLATE_PATH . "/admin/editRegions.php");

}

function editTournament() {
    $id = $_GET['editTournament'];
    $event = Event::getByID($id, 'tournaments');
    require(TEMPLATE_PATH . "/admin/editTournament.php");
}

function editLeague() {
    $id = $_GET['editLeague'];
    $event = Event::getByID($id, 'leagues');
    require(TEMPLATE_PATH . "/admin/editLeague.php");
}

function editSubmission() {
    $id = $_GET['editSubmission'];
    $event = Event::getByID($id, 'submissions');
    require(TEMPLATE_PATH . "/admin/editSubmission.php");
}

function createTournament() {
    $region = $_GET['createTournament'];
    require(TEMPLATE_PATH . "/admin/createTournament.php");
}

function createLeague() {
    $region = $_GET['createLeague'];
    require(TEMPLATE_PATH . "/admin/createLeague.php");
}

function deleteEvent() {
    $type = $_GET['delete'].'s';
    $id = $_GET['id'];

    // @TODO Use AJAX for this
    $event = Event::getByID($id, $type);
    $region = $event->getRegion();
    $event->delete();
    header('Location: ?region='.$region.'&status=eventDeleted');
}

function dashboard() {
    $results = array();
    $results['submissions'] = Event::getSubmissions();
    require(TEMPLATE_PATH . "/admin/dashboard.php");
}