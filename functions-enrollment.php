<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/admin/includes/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/admin/lib/aws/aws-autoloader.php');
use Aws\S3\S3Client;


/**
 * A helper function for creating the sql query to encrypt a field on an insert or update
 * @param $value
 * @return string
 */
function db_aes_encrypt($value) {
    if($value) {
        return "AES_ENCRYPT('".$value."', '".AES_ENCRYPTION_KEY."')";
    } else {
        return "''";
    }
    return $value;
}

/**
 * A helper function for creating the sql query to select a field and decrypt it from the database at the same time.
 * @param $field
 * @return string
 */
function db_aes_decrypt($field) {
    return "AES_DECRYPT(`".$field."`, '".AES_ENCRYPTION_KEY."') as ".$field;
}

/**
 * Helper function for wrapping a normal field in quotes
 * @param $value
 * @return string
 */
function db_normal_field($value) {
    if($value) {
        return "'".$value."'";
    } else {
        return "''";
    }
    return $value;
}

function get_encryption_fields() {
    return array('first_name', 'last_name', 'email', 'ssn', 'dob', 'phone', 'middle_initial');
}

function needs_encryption($field) {
    $fields = get_encryption_fields();
    return in_array($field, $fields);
}

/************************************************************
 * ENROLLMENT FORM
 ***********************************************************/
function retrieve_enrollment_uid($enrollmentId=0) {
    global $wpdb;
    if($enrollmentId) {
        $qry = $wpdb->prepare("select uid from enrollment where id=%d", $enrollmentId);
        $uid = $wpdb->get_var($qry);
        return $uid;
    }
}

function retrieve_enrollment($enrollmentId) {
    global $wpdb;
    if($enrollmentId) {

        $fields = "* ";
        foreach(get_encryption_fields() as $field) {
            $fields.=", ".db_aes_decrypt($field);
        }

        $row = $wpdb->get_row($wpdb->prepare('SELECT '.$fields.' from enrollment WHERE id = %d', $enrollmentId), OBJECT);
        return $row;
    }
}

function retrieve_enrollment_by_uid($uid='') {
    global $wpdb;

    if($uid) {
        $fields = "* ";
        foreach(get_encryption_fields() as $field) {
            $fields.=", ".db_aes_decrypt($field);
        }

        $row = $wpdb->get_row($wpdb->prepare('SELECT '.$fields.' from enrollment WHERE uid = %s', $uid), OBJECT);
        return $row;
    }
}

function retrieve_enrollment_by_wpid($uid='') {
    global $wpdb;

    if($uid) {
        $fields = "* ";
        foreach(get_encryption_fields() as $field) {
            $fields.=", ".db_aes_decrypt($field);
        }

        $row = $wpdb->get_row($wpdb->prepare('SELECT '.$fields.' from enrollment WHERE wpid = %s', $uid), OBJECT);
        return $row;
    }
}

/**
 * Creates the enrollment with an SQL Insert
 */
function create_enrollment($enrollmentId, $data) {
    global $wpdb;
    $data['uid'] = uniqid();
    if($enrollmentId) {
        $data['id'] = $enrollmentId;
    }
    foreach($data as $key => $value) {
        $fields[] = $key;
        if(needs_encryption($key)) {
            $value = db_aes_encrypt($value);
        } else {
            $value = db_normal_field($value);
        }
        $values[] = $value;
    }

    $wpdb->show_errors();
    $sql = "INSERT INTO enrollment(".implode($fields,", ").") VALUES (".implode($values,", ").");";
    $wpdb->query($sql);
    return $wpdb->insert_id;
}

/**
 * Update the existing enrollment with an SQL Update
 */
function update_enrollment($enrollmentId, $data) {
    global $wpdb;
    //$wpdb->show_errors();

    foreach($data as $key => $value) {
        if(needs_encryption($key)) {
            $value = db_aes_encrypt($value);
        } else {
            $value = db_normal_field($value);
        }
        $values[] = "`".$key."` = ".$value;
    }

    $sql = "UPDATE enrollment set ".implode($values,", ")." where id = ".$enrollmentId;
    error_log ( $sql);
    $wpdb->query($sql);
}

function get_enrollment_post_data() {
    $data = array();
    $fields = explode(",",$_POST['fieldNames']);
    foreach($fields as $field) {
        /** We don't want to insert/update the enrollment Id **/
        if($field!='enrollmentId')
            $data[$field] = $_POST[$field];
    }
    return $data;
}

function process_enrollment_form() {
    global $wpdb;
    $enrollmentId = intval($_POST['enrollmentId']);
    $step = $_POST['step'];
    $data = get_enrollment_post_data();
    $data['step'] = $step;
    $uid = retrieve_enrollment_uid($enrollmentId);

    if($uid) {
        update_enrollment($enrollmentId, $data);
    } else {
        create_enrollment($enrollmentId, $data);
    }

    $qry = "update enrollment set last_visit=NOW() where id=" . $enrollmentId;
    $wpdb->get_results($qry);

    /* Update the session */
    if($_POST['next_step']) {
        $_SESSION['enrollment_step'] = $_POST['next_step'];
    }
    if($enrollmentId) {
        $_SESSION['enrollmentId'] = $enrollmentId;
    }
}

/**
 * Uploads the enrollment doc to Amazon S3.  It encrypts the file with AES256 encryption
 * and stores the key for the file in the enrollment_doc table
 * @param $enrollmentId
 * @return int Returns the number of files it uploaded
 */
function upload_enrollment_doc_s3($enrollmentId) {
    global $wpdb;
    $client = S3Client::factory(array(
        'key' => S3_ACCESS_KEY_ID,
        'secret' => S3_SECRET_KEY
    ));

    $count = 0;

	if(isset($_REQUEST['type'])) {

        $source = $_FILES["webcam"]["tmp_name"];
        if(!$source) {
            continue;
        }
        $name = $_FILES["webcam"]["tmp_name"].'.jpg';

        /* Create a random 32 character key */
        $key = wp_generate_password(32, false);
        $result = $client->putObject(array(
            'Bucket'     => S3_BUCKET,
            'Key'        => $key,
            'SourceFile' => $source,
            'ServerSideEncryption' => 'AES256'
        ));

        $wpdb->insert(
            'enrollment_doc',
            array(
                'enrollment_id' => $enrollmentId,
                'name' => $name,
                'url' => $result['ObjectURL'],
                'key' => $key
            ),
            array(
                '%d',
                '%s',
                '%s',
                '%s'
            )
        );
        $count++;
	
	} else {
		
	    try {
	        foreach ($_FILES["documents"]["error"] as $key => $error) {
	            $source = $_FILES["documents"]["tmp_name"][$key];
	            if(!$source) {
	                continue;
	            }
	            $name = $_FILES["documents"]["name"][$key];
	
	            /* Create a random 32 character key */
	            $key = wp_generate_password(32, false);
	            $result = $client->putObject(array(
	                'Bucket'     => S3_BUCKET,
	                'Key'        => $key,
	                'SourceFile' => $source,
	                'ServerSideEncryption' => 'AES256'
	            ));
	
	            $wpdb->insert(
	                'enrollment_doc',
	                array(
	                    'enrollment_id' => $enrollmentId,
	                    'name' => $name,
	                    'url' => $result['ObjectURL'],
	                    'key' => $key
	                ),
	                array(
	                    '%d',
	                    '%s',
	                    '%s',
	                    '%s'
	                )
	            );
	            $count++;
	        }
	    } catch (Exception $e) {
	        echo $e->getMessage();
	    }

	}
	
    return $count;
}

add_action('wp_ajax_enrollment_form', 'process_enrollment_form');
add_action('wp_ajax_nopriv_enrollment_form', 'process_enrollment_form');

?>