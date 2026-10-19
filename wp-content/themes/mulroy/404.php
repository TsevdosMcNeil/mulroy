<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */

get_header();
?>
<style>
	footer {
		display: none !important;
	}
</style>
<section class="not__found__page">
	<div class="page-sect-content gap-[1.1rem]">
		<div class="content__404__wrapper">
			<h1>404</h1>
			<p>It looks like nothing was found at this location. </p>
		</div>
	</div>
</section>

<?php
get_footer();
