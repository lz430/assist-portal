<?php
/*
Template Name: 404 Template
*/
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();


?>

    <div id="content" class="row-fluid">
        <div class="span9 main">

            <div>

                <h1 class="page-title">Error 404 - Page Not Found</h1>

                <p>This might have been because: </p>

                <p>You have typed the web address incorrectly, or the page you are looking for may have been moved, updated, or deleted.  </p>

                <p>Please try using the navigation area above to see if it's available elsewhere. </p>

            </div>



        </div>


        <div class="span3 hidden-tablet">
            <? get_sidebar()?>
        </div>

    </div>
<?php get_footer(); ?>