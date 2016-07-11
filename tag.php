<?
include(get_template_part_acf('templates/partials/header'));

$term_id = get_query_var('tag_id');
$taxonomy = 'post_tag';
$args ='include=' . $term_id;
$terms = get_terms( $taxonomy, $args ); ?>

<div class="wrapper terms">
    <h3 class="entry-title"><?= $terms[0]->slug; ?></h3>
</div>

<section id="post-blog">
    <? if ( have_posts() ):
    include(get_template_part_acf( 'templates/loop','post' )); ?>

    <div class="center pagination">
        <?= get_previous_posts_link( ); ?>
        <?= get_next_posts_link( ); ?>
    </div>
    <? else:
        include(get_template_part_acf( 'templates/content', 'none' ));
    endif; ?>
</section>

<? include(get_template_part_acf('templates/partials/footer'));
