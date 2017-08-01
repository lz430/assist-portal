<?


/// THIS IS NOT THE WORKING FILE, SEE /enrollment/enrollment-form-process.php ///


$isSubmission = $_REQUEST["submitted"] == "true";
$isUpload = isset($_REQUEST['fileupload']);
$isReview = !$isSubmission && !$isUpload && isset($_REQUEST['enrollmentId']);
$isCompletedUpload = isset($_REQUEST['uploadComplete']);
$isLookup = isset($_REQUEST['lEnrollmentId']);
$isLoad = isset($_REQUEST['uid']);

if($isLoad && !$isReview && !$isUpload) {
    $enrollment = retrieve_enrollment_by_uid($_REQUEST['uid']);
    if($enrollment) {
        $currentStep = $enrollment->step+1;
        $enrollmentId = $enrollment->id;

        $_SESSION['enrollment_step'] = $currentStep;
        $_SESSION['enrollmentId'] = $enrollment->id;
    }
} else if ($isLookup) {

    $enrollmentId = intval($_REQUEST['lEnrollmentId']);
    global $wpdb;
    $qry = "select uid from enrollment where id=" . $enrollmentId . " and ssn='" . mysql_real_escape_string($_REQUEST["lSsn"]) . "'";
    $uid = $wpdb -> get_var($qry);

    if ($uid == null) {
        header('Location: /enrollment-not-found');
    } else {
        header('Location: ?uid=' . $uid . '&enrollmentId=' . $enrollmentId);
    }

    die();

} else if ($isSubmission) {

    /* Send email */
    $enrollmentId = intval($_REQUEST['enrollmentId']);
    $enrollment = retrieve_enrollment($enrollmentId);

    $headers = 'From: info@assistwireless.com' . "rn" . 'Reply-To: info@assistwireless.com' . "rn" . 'X-Mailer: PHP/' . phpversion();
    //neworders@assistwireless.com
    mail("neworders@assistwireless.com", "Assist Sign-Up", "Account #" . $enrollment->id . " was just signed up on the Assist Wireless web site.", $headers);

    $headers = 'MIME-Version: 1.0' . "rn";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "rn";
    $headers .= 'From: info@assistwireless.com' . "rn" . 'Reply-To: info@assistwireless.com';

    $url = "https://www.assistwireless.com/enrollment-form/?uid=" . $enrollment->uid . "&enrollmentId=" . $enrollment->id;

    $msg = "Thank you for signing-up with Assist Wireless. You can track the progress of your enrollment, as well as upload your documentation at the following url: <a href='" . $url . "'>" . $url . "</a>";
    mail($_REQUEST["email"], "Your Assist Wireless Enrollment Page", $msg, $headers);

    header('Location: ?uid=' . $enrollment->uid . '&enrollmentId=' . $enrollment->id);

    die();

} else if ($isUpload) {

    $id = intval($_REQUEST['enrollmentId']);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/enrollmentFiles/" . $id . "/";

    if (!is_dir($path)) {
        mkdir($path);
    }

    $fileCount = 0;
    foreach ($_FILES["documents"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["documents"]["tmp_name"][$key];
            $name = $_FILES["documents"]["name"][$key];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $name = uniqid() . "." . $ext;
            if (!move_uploaded_file($tmp_name, $path . $name)){
                //echo "could not move file";
            }
            $fileCount++;
        }
    }

    if ($fileCount > 0){
        $qry = "update enrollment set complete=1, completed_date=now() where id=" . $id;
        $wpdb -> get_results($qry);
    }
    $_SESSION['enrollmentId'] = null;
    header('Location: /enrollment-thankyou/');

    die('');

} else if ($isReview) {
    $enrollmentId = intval($_REQUEST['enrollmentId']);
    $uid = $_REQUEST["uid"];
} else {
    global $wpdb;

    $enrollment = NULL;
    $currentStep = $_SESSION['enrollment_step'];
    $enrollmentId = intval($_SESSION['enrollmentId']);
	$wpid = get_current_user_id();
	
	if($wpid != 0) {
		$qry = $wpdb->get_row("SELECT id FROM enrollment WHERE wpid = $wpid");
        $enrollmentId = $qry->id;
	}
	
    if(!$enrollmentId) {
        $qry = "insert into enrollment_id () values()";
        $wpdb -> get_results($qry);
        $enrollmentId = mysql_insert_id();
    } else {
        $enrollment = retrieve_enrollment($enrollmentId);
    }

    $qry = "select uid from enrollment where id=" . $enrollmentId;
    $uid = $wpdb -> get_var($qry);

    if(!$currentStep) {
        $currentStep = 1;
    }
}

?>