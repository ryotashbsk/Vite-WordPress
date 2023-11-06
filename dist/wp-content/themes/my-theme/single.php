<?php
get_header();

if (is_singular('news')) {
    get_template_part('inc/posts/postDefault');
}

get_footer();
