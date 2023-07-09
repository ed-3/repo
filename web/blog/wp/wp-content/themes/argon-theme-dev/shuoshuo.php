<?php 
/*
Template Name: 说说
* 该页面可以用 归档页 替代
*/
$paged = isset($_GET['current_page']) ? $_GET['current_page'] : 1;
query_posts("post_type=shuoshuo&post_status=publish&posts_per_page=30&paged=$paged");
?>

<?php get_header(); ?>

<div class="page-information-card-container">
	<div class="page-information-card card bg-gradient-secondary shadow-lg border-0">
		<div class="card-body">
			<h3 class="text-black" style="text-align: center;">🌸小窝🌸</h3>
			<?php if (the_archive_description() != ''){ ?>
				<p class="text-black mt-3">
					<?php the_archive_description(); ?>
				</p>
			<?php } ?>
			<p class="text-black mt-3 mb-0 opacity-8">
				<i class="fa fa-quote-left fa-2x"></i>
				<?php
				$post_id = get_the_ID();
				$created_time = get_the_time('U', $post_id);
				$current_time = time();

				$time_diff = $current_time - $created_time;
				$days_diff = floor($time_diff / 86400);

				// 输出天数差
				echo "在过去的 " . $days_diff . " 天里, 我一共碎碎杂念了 ". wp_count_posts('shuoshuo','') -> publish . " 句话 ";
				?>
				<i class="fa fa-quote-right fa-2x"></i>
			</p>
		</div>
	</div>
</div>

<?php get_sidebar(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php if ( have_posts() ) : ?>
		<?php
			while ( have_posts() ) :
				the_post();
				do_action( 'argon_single_content', 'shuoshuo' );
			endwhile;
		?>
		<?php
			echo get_argon_formatted_paginate_links_for_all_platforms(array(
				'format' => '?current_page=%#%',
			));
		?>
		<?php
	else :
		get_template_part( 'template-parts/preview/content', 'none-tag' );
	endif;
	?>

<?php get_footer(); ?>
