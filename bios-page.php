<?php
/*
Template Name: Bios Template
*/
if (!function_exists('wp') && !empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die ('You do not have sufficient permissions to access this page!');
}
get_header();

?>

        <div id="content" class="row-fluid">
            <div class="span12 main">
                <?php if (have_posts()) : ?>
        
                <div class="breadcrumbs">
                    <?php if (function_exists('bcn_display')) {
                    bcn_display();
                }?>
                </div>
                <?php while (have_posts()) : the_post(); ?>
                
                    <h1 class="page-title"><? the_title() ?></h1>

                    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <div class="featured-image"><? if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        } ?></div>
                        <?php the_content('Read the rest of this entry &raquo;'); ?>
                                
                        <div class="leadership-area">
                          <?php if(get_field('assist_leadership_team')): ?>
                            <?php $profile_counter = 1; ?>
                            <?php while(the_repeater_field('assist_leadership_team')): ?>

                            <div class="leadership-profile">
                                <div class="leadership-profile-in">                            
                                    <div class="leadership-img"><img src="<?php the_sub_field('upload_profile_image') ?>" alt="Profile Image" class="alignnone"></div>
                                    <div class="leadership-name"><?php the_sub_field('profile_name') ?></div>
                                    <div class="leadership-position"><?php the_sub_field('profile_positon') ?></div>
                                </div>
                                <div class="leadership-popup"><a class="fancybox" href="#leadership-description-<?php echo $profile_counter; ?>"></a></div>
                                <div id="leadership-description-<?php echo $profile_counter; ?>" class="leadership-description">
                                  <div class="leadership-popup-img"><img src="<?php the_sub_field('upload_profile_image') ?>" alt="Profile Image" class="alignnone"></div>
                                  <div class="leadership-popup-name"><strong><?php the_sub_field('profile_name') ?>, &nbsp;</strong><?php the_sub_field('profile_positon') ?></div>
                                  <div class="leadership-text"><?php the_sub_field('profile_description') ?></div>
		                          <?php if(get_sub_field('linkedin_url')): ?>
                                    <div class="leadership-linkedin"><a target="_blank" href="<?php the_sub_field('linkedin_url') ?>">Get in touch. </a></div>
        		                  <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php $profile_counter++; ?>
                            <?php endwhile; endif; ?>
                        </div>
                                
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        
        </div>
    
<?php get_footer(); ?>