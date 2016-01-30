<?php
require("../../config.php");
// @TODO Implement File Upload

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $type = isset($_GET['type']) ? $_GET['type'] : "";
        $create = (isset($_GET['create']) && $_GET['create'] == 'true') ? true : false;

        // Sanitize a specific input field
        function sanitize_input($field)
        {
            $field = strip_tags(trim($field));
            $field = str_replace(array('\r', '\n'), array('', ''), $field);
            return $field;
        }

        function update_event_object($event, $name, $url, $description, $prize, $fee, $region, $signups)
        {
            $event->setRegion($region);
            $event->setName($name);
            $event->setDescription($description);
            $event->setPrize($prize);
            $event->setFee($fee);
            $event->setSignup($signups);
            $event->setUrl($url);
        }


        // Sanitize form elements that are the same for all event types
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $name = sanitize_input($name);
        $url = isset($_POST['url']) ? $_POST['url'] : null;
        $url = sanitize_input($url);
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $description = sanitize_input($description);
        $prize = isset($_POST['prize']) ? $_POST['prize'] : null;
        $prize = sanitize_input($prize);
        $fee = isset($_POST['fee']) ? $_POST['fee'] : null;
        $fee = sanitize_input($fee);
        $region = isset($_POST['region']) ? $_POST['region'] : null;
        $signups = isset($_POST['signups']) ? $_POST['signups'] : null;
        $id = intval($_POST['eventid']);

        switch ($type) {
            case 'tournament':
                // Sanitize tournament-specific input
                $format = isset($_POST['format']) ? $_POST['format'] : null;
                $format = sanitize_input($format);

                if ($create) {
                    if (isset($_FILES["logoUpload"]) && !empty( $_FILES["logoUpload"]["name"] )) {
                        include_once '../../uploadFile.php';
                    } else {
                        $picture = null;
                    }

                    $tournament = new Tournament(null, $region, $name, $url, $description, $format, $fee,
                        $prize, $signups, $picture);
                    $tournament->insert();
                    header('Location: ../../admin.php?region=' . $tournament->getRegion() . '&status=changesSaved');
                    return;
                }

                if (!$event = Event::getByID($id, 'tournaments')) {
                    header('Location: ../../admin.php?error=eventNotFound');
                    return;
                }

                update_event_object($event, $name, $url, $description, $prize, $fee, $region, $signups);
                $event->setFormat($format);
                if (isset($_FILES["logoUpload"]) && !empty( $_FILES["logoUpload"]["name"] )) {
                    include_once '../../uploadFile.php';
                    $event->setPicture($picture);
                }
                $event->update();
                header('Location: ../../admin.php?editTournament=' . $id . '&status=changesSaved');
                break;
            case 'league':
                // Sanitize league-specific input
                $signups_comment = isset($_POST['signups-comment']) ? $_POST['signups-comment'] : null;
                $signups_comment = sanitize_input($signups_comment);

                if ($create) {
                    if (isset($_FILES["logoUpload"]) && !empty( $_FILES["logoUpload"]["name"] )) {
                        include_once '../../uploadFile.php';
                    } else {
                        $picture = null;
                    }
                    $league = new League(null, $region, $name, $url, $description, $fee, $prize, $signups,
                        $signups_comment, $picture);
                    $league->insert();
                    header('Location: ../../admin.php?region=' . $league->getRegion() . '&status=changesSaved');
                    return;
                }

                if (!$event = Event::getByID($id, 'leagues')) {
                    header('Location: ../../admin.php?error=eventNotFound');
                    return;
                }

                update_event_object($event, $name, $url, $description, $prize, $fee, $region, $signups);
                $event->setSignupDescription($signups_comment);
                if (isset($_FILES["logoUpload"]) && !empty( $_FILES["logoUpload"]["name"] )) {
                    include_once '../../uploadFile.php';
                    $event->setPicture($picture);
                }
                $event->update();
                header('Location: ../../admin.php?editLeague=' . $id . '&status=changesSaved');
                break;
            case 'submission':
                // Sanitize submission-specific input
                $format = isset($_POST['format']) ? $_POST['format'] : null;
                $format = sanitize_input($format);
                $signups_comment = isset($_POST['signups-comment']) ? $_POST['signups-comment'] : null;
                $signups_comment = sanitize_input($signups_comment);
                $eventtype = isset($_POST['eventtype']) ? $_POST['eventtype'] : null;

                if (!$event = Event::getByID($id, 'submissions')) {
                    header('Location: ../../admin.php?error=eventNotFound');
                    return;
                }

                update_event_object($event, $name, $url, $description, $prize, $fee, $region, $signups);
                if (isset($_FILES["logoUpload"]) && !empty( $_FILES["logoUpload"]["name"] )) {
                    include_once '../../uploadFile.php';
                    $event->setPicture($picture);
                }
                $event->setFormat($format);
                $event->setSignupDescription($signups_comment);
                $event->setType($eventtype);

                if($eventtype == 'League') {
                    $picture = $event->getPicture();
                    $league = new League(null, $region, $name, $url, $description, $fee, $prize, $signups,
                        $signups_comment, $picture);
                    $league->insert();
                    $event->delete();
                    header('Location: ../../admin.php?status=changesSaved');
                }
                elseif ($eventtype == 'Tournament') {
                    $picture = $event->getPicture();
                    $tournament = new Tournament(null, $region, $name, $url, $description, $format, $fee,
                        $prize, $signups, $picture);
                    $tournament->insert();
                    $event->delete();
                    header('Location: ../../admin.php?status=changesSaved');
                }
                else {
                    $event->update();
                    header('Location: ../../admin.php?editSubmission=' . $id . '&status=changesSaved');
                }
                break;
        }
    }
    elseif (isset($_POST['cancel'])) {
        header('Location: ../../admin.php');
    }
    elseif (isset($_POST['delete'])) {
        $type = isset($_GET['type']) ? $_GET['type'] : "";
        $id = intval($_POST['eventid']);
        $region = isset($_POST['region']) ? $_POST['region'] : null;

        switch ($type) {
            case 'tournament':
                if (!$event = Event::getByID($id, 'tournaments')) {
                    header('Location: ../../admin.php?error=eventNotFound');
                    return;
                }

                $event->delete();
                header('Location: ../../admin.php?region=' . $region . '&status=eventDeleted');
                break;
            case 'league':
                if (!$event = Event::getByID($id, 'leagues')) {
                    header('Location: ../../admin.php?error=eventNotFound');
                    return;
                }

                $event->delete();
                header('Location: ../../admin.php?region=' . $region . '&status=eventDeleted');
                break;
            case 'submission':
                if (!$event = Event::getByID($id, 'submissions')) {
                    header('Location: ../../admin.php?error=eventNotFound');
                    return;
                }

                $event->delete();
                header('Location: ../../admin.php?status=eventDeleted');
                break;
        }
    }
}
