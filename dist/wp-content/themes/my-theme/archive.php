<?php
get_header();
$post_type = get_query_var('post_type');
?>

<header class="pageHeader">
  <h1 class="pageHeader-title"><?php echo $post_type; ?></h1>
</header>

<?php
if (is_post_type_archive('news')) {
    get_template_part('inc/archives/archiveDefault');
}
?>

<?php
get_footer();
