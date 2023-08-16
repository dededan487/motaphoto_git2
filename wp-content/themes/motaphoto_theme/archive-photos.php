<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <header class="page-header">
            <h1 class="page-title">
                <?php post_type_archive_title(); ?>
            </h1>
        </header>

        <?php
        while (have_posts()) :
            the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h2><?php the_title(); ?></h2>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>

        <?php endwhile; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
