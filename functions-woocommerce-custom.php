<?

add_theme_support( 'woocommerce' );

/** Woocommerce loop for a single product page  */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action('woocommerce_after_single_product_summary', 'assist_woocommerce_clearfix', 5);
function assist_woocommerce_clearfix() {
    echo "<div class='clearfix'></div>";
}

add_action('woocommerce_after_product', 'woocommerce_upsell_display', 15);

/* Display the decription, categories, and short description */
add_action( 'woocommerce_before_shop_loop', 'assist_woocommerce_category_list', 40 );
function assist_woocommerce_category_list() {
    $terms = get_terms('product_cat', array(
        'exclude' => array(21)
    ));
    echo "<ul class='product-categories'>";
    foreach($terms as $term) {
        echo "<li class='".$term->slug."'>".$term->name."</li>";
    }
    echo "</ul>";
}

/* Display the decription, categories, and short description */
add_action( 'woocommerce_single_product_summary', 'assist_woocommerce_product_details', 6 );
function assist_woocommerce_product_details() {
    echo '<div class="description">'.the_content().'</div>';
    echo '<div class="excerpt">'.the_excerpt().'</div>';
}

/** Add the tags to the post class  */
add_filter( 'post_class', 'assist_woocommerce_post_class', 20, 3 );
function assist_woocommerce_post_class($classes, $class, $post_id) {


    $product = get_product( $post_id );
    if($product->regular_price==0) {
        $classes[] = 'free';
    }
    $tags = get_the_terms( $post_id, 'product_tag' );
    if($tags) {
        foreach($tags as $tag) {
            $classes[] = $tag->slug;
        }
    }
    return $classes;
}

/** Add the category icons to the shop page */
add_action( 'woocommerce_before_shop_loop_item', 'assist_woocommerce_post_categories', 15);
function assist_woocommerce_post_categories() {

    $categories = get_the_terms(get_the_ID(), 'product_cat');
    if($categories) {
        echo "<span class='categories'>";
        foreach($categories as $cat) {
            echo "<span class='category ".$cat->slug."'></span>";
        }
        echo "</span>";
    }
}

/** Exclude the accessories category */
add_action( 'pre_get_posts', 'assist_pre_get_posts_query' );
function assist_pre_get_posts_query( $q ) {

    if ( ! $q->is_main_query() ) return;
    if ( ! $q->is_post_type_archive() ) return;
    if ( ! is_admin() &&  is_shop() ) {

        $q->set( 'tax_query', array(array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array( 'accessory' ), // Don't display products in the knives category on the shop page
            'operator' => 'NOT IN'
        )));
    }
    remove_action( 'pre_get_posts', 'assist_pre_get_posts_query' );

}
?>