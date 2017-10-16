<?php /* Loop Template used for index/archive/search */ ?>
<article <?php post_class('mh-loop-item clearfix'); ?>>
	<figure class="mh-loop-thumb">
		<a class="mh-thumb-icon" href="<?php the_permalink(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('mh-magazine-content');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-content.png' . '" alt="' . esc_html__('No Picture', 'mh-magazine') . '" />';
			} ?>
		</a>
		<?php if (has_category()) { ?>
			<div class="mh-image-caption mh-loop-caption">
				<?php $category = get_the_category(); echo esc_attr($category[0]->cat_name); ?>
			</div>
		<?php } ?>
	</figure>
	<div class="mh-loop-content clearfix">
		<header class="mh-loop-header">
			<h3 class="entry-title mh-loop-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
			<div class="mh-meta mh-loop-meta">
				<?php mh_magazine_loop_meta(); ?>
			</div>
		</header>
		<div class="mh-loop-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>