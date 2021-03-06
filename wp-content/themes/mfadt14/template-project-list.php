<?php
/*
Template Name: Project List
*/

get_header();

$args = array ('post_type' => 'project', 'posts_per_page' => '-1', 'orderby' => 'rand');
$query = new WP_Query( $args );

?>

<!-- html goes here -->

<section id="projects" class="container">
	<h1 class="sixteen columns">Projects</h1>

	<?php

	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

		// Set up student/s name
		$students_list = array();
		$students = types_child_posts('student');
		foreach ($students as $student) { $students_list[] = $student->post_title; }
		$students = join(" + ", $students_list);

		// Set up category name
		$category = get_the_category();
		$category = $category[0]->cat_name;

		// Set up tags
		$a = array();
		$tags = get_the_tags();
		foreach($tags as $t) {
			$a[] = $t->name;
		}
		$tags = join(', ', $a);

	?>


	<div class="masonry columns">
		<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
		<p><?= $students ?></p>
		<!-- <?= $category ?> -->
		<!-- <?= $tags ?> -->

	  <? if (has_post_thumbnail()) : ?>
		<img class="projectThumb" src="<? $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); print $src[0]; ?>">
		<? else: ?>
		<img class="projectThumb" src="assets/img/no-thumbnail-<? $r=rand(0,3);if($r>2)$o='sm';elseif($r>1)$o='md';else $o='lg'; print $o; ?>.jpg">
		<?php endif; ?>

	</div>

	<?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
