<?
session_start();
$enrollment = null;
$isSubmission = isset($_REQUEST["submitted"]) && $_REQUEST["submitted"] == "true";
$isUpload = isset($_REQUEST['fileupload']);
$isWebcam = isset($_REQUEST['data_uri']);
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
    $qry = "select uid from enrollment where id=" . $enrollmentId . " and ssn=" . db_aes_encrypt($_REQUEST["lSsn"]);
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

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $headers .= 'From: info@assistwireless.com' . "\r\n" . 'Reply-To: info@assistwireless.com';

    $url = "https://www.assistwireless.com/enrollment-form/?uid=" . $enrollment->uid . "&enrollmentId=" . $enrollment->id;

    //$msg = "Thank you for signing-up with Assist Wireless. You can track the progress of your enrollment, as well as upload your documentation at the following url: <a href='" . $url . "'>" . $url . "</a>";

    $filePath = __FILE__;
    $filePath = str_replace ("enrollment-form-process.php" , "signupEmail.html", $filePath);
    $body = file_get_contents($filePath, false);

    $body = str_replace("-URL-", $url, $body);

    mail($_REQUEST["email"], "Your Assist Wireless Enrollment Page", $body, $headers);

    header('Location: ?uid=' . $enrollment->uid . '&enrollmentId=' . $enrollment->id);

    die();

} else if ($isUpload) {

    $id = intval($_REQUEST['enrollmentId']);
    $fileCount = upload_enrollment_doc_s3($id);

    if ($fileCount > 0){
        if (isset($_SESSION['enrollment_email_id'])){
            $emid = intval($_SESSION['enrollment_email_id']);
            $qry = "update enrollment set complete=1, completed_email_id=".$emid.", completed_date=now() where id=" . $id;
        } else {
            $qry = "update enrollment set complete=1, completed_date=now() where id=" . $id;
        }

        $wpdb->get_results($qry);
    }
    $_SESSION['enrollmentId'] = null;
    header('Location: /enrollment-thankyou/');

    die('');

} else if ($isWebcam) {

    $id = intval($_REQUEST['enrollmentId']);
    $fileCount = upload_enrollment_doc_s3($id);

    if ($fileCount > 0){
        if (isset($_SESSION['enrollment_email_id'])){
            $emid = intval($_SESSION['enrollment_email_id']);
            $qry = "update enrollment set complete=1, completed_email_id=".$emid.", completed_date=now() where id=" . $id;
        } else {
            $qry = "update enrollment set complete=1, completed_date=now() where id=" . $id;
        }

        $wpdb->get_results($qry);
    }
    $_SESSION['enrollmentId'] = null;
    header('Location: /enrollment-thankyou/');

    die('');

} else if ($isReview) {
    $enrollmentId = intval($_REQUEST['enrollmentId']);
    $uid = $_REQUEST["uid"];
    $enrollment = retrieve_enrollment($enrollmentId);
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
        $enrollmentId = $wpdb->insert_id;
    } else {
        $enrollment = retrieve_enrollment($enrollmentId);
    }
    if(!$currentStep) {
        $currentStep = 1;
    }
}