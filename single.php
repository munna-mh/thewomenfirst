<?php get_header(); ?>

<main class="site-main single-post-main">
    <div class="container">
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            <!-- Reading Progress Bar -->
            <div class="reading-progress">
                <div class="progress-bar"></div>
            </div>

            <header class="post-header">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <h1 class="post-title"><?php the_title(); ?></h1>

                <div class="post-meta">
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                    <span class="post-categories"><?php echo get_the_category_list(', '); ?></span>
                    <span class="read-time"><?php echo estimate_reading_time(); ?> min read</span>
                </div>
            </header>

            <div class="post-content">
                <?php the_content(); ?>

                <?php
                // Page breaks for multi-page posts
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'thewomenfirst'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <footer class="post-footer">
                <?php if (has_tag()) : ?>
                    <div class="post-tags">
                        <strong>Tags:</strong> <?php the_tags('', ', ', ''); ?>
                    </div>
                <?php endif; ?>

                <!-- Social Sharing -->
                <div class="social-sharing">
                    <h4>Share this article:</h4>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="share-btn facebook">Facebook</a>
                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php the_permalink(); ?>" target="_blank" class="share-btn twitter">Twitter</a>
                        <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo get_the_post_thumbnail_url(); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-btn pinterest">Pinterest</a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>" target="_blank" class="share-btn linkedin">LinkedIn</a>
                    </div>
                </div>
            </footer>
        </article>

        <!-- Forbes-Style Continuous Reading Section -->
        <section class="continuous-reading" id="continuous-reading">
            <h3>Continue Reading</h3>
            <div class="suggested-articles" id="suggested-articles">
                <!-- Articles will load here via JavaScript -->
            </div>
            <div class="loading-spinner" id="loading-spinner" style="display: none;">
                <div class="spinner"></div>
                <p>Loading more insightful content...</p>
            </div>
        </section>

        <!-- Comments Section -->
        <?php if (comments_open() || get_comments_number()) : ?>
            <section class="comments-section">
                <?php comments_template(); ?>
            </section>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>