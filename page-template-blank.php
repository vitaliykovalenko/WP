<?php
/*
Template Name: Blank Page Template 
*/

if (have_posts()) : while (have_posts()) : the_post(); 
?>

<?php global $cbt_options; ?>
<!doctype html>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php // Google Chrome Frame for IE ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Добавьте имя блога. / Add the blog name.
	bloginfo( 'name' );

	// Добавьте описание блога для Главной страницы. / Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'cbt' ), max( $paged, $page ) );

	?></title>

<?php // mobile meta (hooray!) ?>
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!--Shortcut icon-->
<?php if(!empty($cbt_options['apple-touch-icon']['url'])) { ?>
	<link rel="apple-touch-icon" href="<?php echo $cbt_options['apple-touch-icon']['url']; ?>" />
<?php } ?>
<?php if(!empty($cbt_options['favicon']['url'])) { ?>
	<link rel="shortcut icon" href="<?php echo $cbt_options['favicon']['url']; ?>" />
<?php } ?>

<!--[if IE]>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
<![endif]-->
<?php // or, set /favicon.ico for IE10 win ?>
<meta name="msapplication-TileColor" content="<?php echo $cbt_options['header-color']; ?>">
<?php if(!empty($cbt_options['favicon']['url'])) { ?>
<meta name="msapplication-TileImage" content="<?php echo $cbt_options['favicon']['url']; ?>">
<?php } ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php // wordpress head functions ?>
<?php wp_head(); ?>
<?php // end of wordpress head ?>

<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/library/js/libs/respond.min.js"></script>
<![endif]-->

<?php // drop Google Analytics Here ?>
<?php // end analytics ?>


</head>

<body <?php body_class(); ?> style="background-color: <?php echo $cbt_options['content-bg'];?>">


<?php if($cbt_options['boxed_layout'] == '1') echo '<div id="boxed">'; ?>


<div id="main_area">

<?php 
ob_start();
	the_content(); 
	$content = ob_get_contents();
ob_end_clean();

?>

      <div class="container">

        <div id="content" class="clearfix row">
        
          <div id="main" class="col-md-12 clearfix" role="main">

          <?php //get_template_part( 'breadcrumb' ); ?>

            
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
              
            
              <section class="page-content entry-content clearfix" itemprop="articleBody">
                
              	<?php echo $content; ?>
            
              </section> <!-- end article section -->
              
              <footer>
        
                <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags",'cbt') . ':</span> ', ', ', '</p>'); ?>
                
              </footer> <!-- end article footer -->
            
            </article> <!-- end article -->
                        

        
          </div> <!-- end #main -->
      
        </div> <!-- end #content -->

      </div> <!-- end .container -->


<?php endwhile; ?> 

	<?php if($cbt_options['boxed_layout'] == '1') echo '</div>'; ?>

    <?php if(!empty($cbt_options['google-analytics'])) echo $cbt_options['google-analytics']; ?> 

    <!-- all js scripts are loaded in library/bones.php -->
    <?php wp_footer(); ?>
    <!-- Hello? Doctor? Name? Continue? Yesterday? Tomorrow?  -->

  </body>

</html> <!-- end page. what a ride! -->

<?php else : ?>

<?php get_template_part('not-found'); ?>

<?php endif; ?>
