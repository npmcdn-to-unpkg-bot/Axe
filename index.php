<?php include(get_template_part_acf('templates/partials/header'));
if (have_posts()):
    # Sort this out, Blog is not loading
    if (is_front_page() && is_home()):
        echo '<!-- template: index/blog -->';
        include(get_template_part_acf('templates/content', 'blog'));
    elseif (is_front_page() or is_home()):
        echo '<!-- template: index/home -->';
        include(get_template_part_acf('templates/content', 'blog'));
    elseif (is_archive()):
        $terms = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $category = $terms->taxonomy;
        if (file_exists(get_template_directory() . '/templates/archive-' . $category . '.php')):
            echo '<!-- template: index/archive-' . $category . ' -->';
            include(get_template_part_acf('templates/archive', $category));
        else:
            echo '<!-- template: index/archive -->';
            include(get_template_part_acf('templates/archive', 'default'));
        endif;
    elseif (is_search()):
        echo '<!-- template: index/search -->';
        include(get_template_part_acf('templates/content', 'search'));
    elseif (is_single()):
        while (have_posts()): the_post();
            if (!get_post_format()) {
                include(get_template_part_acf('templates/format', 'standard'));
            } else {
                include(get_template_part_acf('templates/format', get_post_format()));
            }
        endwhile;
    else:
        if (file_exists(get_template_directory() . '/templates/content-' . $post->post_name . '.php')):
            while (have_posts()) : the_post();
                echo '<!-- template: index/content-' . $post->post_name . ' -->';
                include(get_template_part_acf('templates/content', $post->post_name));
            endwhile;
        else:
            echo '<!-- template: index/page -->';
            include(get_template_part_acf('templates/content', 'page'));
        endif;
    endif;

else:
    echo '<!-- template: index/no_posts -->';
    include(get_template_part_acf('templates/none'));
endif;

include(get_template_part_acf('templates/partials/footer'));
