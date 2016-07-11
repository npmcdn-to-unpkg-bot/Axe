<? get_template_part('templates/partials/header');
$test = 'this worked';
while (have_posts()) : the_post();
    if (is_front_page()):
        echo '<!-- template: page/home -->';
//        get_template_part('templates/content', 'home');
        include(get_template_part_acf('templates/content', 'home'));
    else:
        if (file_exists(get_template_directory() . '/templates/content-' . $post->post_name . '.php')):
            echo '<!-- template: page/' . $post->post_name . ' -->';
            include(get_template_part_acf('templates/content', $post->post_name));
        else:
            echo '<!-- template: page/page -->';
            include(get_template_part_acf('templates/content', 'page'));
        endif;
    endif;
endwhile;

include(get_template_part_acf('templates/partials/footer'));
