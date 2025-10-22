<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Strong Heart. Bold Life.</h1>
        <p>Your trusted guide to women's health, empowerment, and evidence-based wellness.</p>
        <a href="/resources" class="cta-button">Get Free Resources</a>
    </div>
</section>

<!-- Category Filter Bar -->
<section class="filter-section">
    <div class="container">
        <div class="category-filters">
            <button class="filter-btn active" data-category="all">All Topics</button>
            <button class="filter-btn" data-category="hormone-health">Hormone Health</button>
            <button class="filter-btn" data-category="mental-wellness">Mental Wellness</button>
            <button class="filter-btn" data-category="reproductive-health">Reproductive Health</button>
            <button class="filter-btn" data-category="nutrition">Nutrition</button>
            <button class="filter-btn" data-category="fitness">Fitness</button>
        </div>
    </div>
</section>

<!-- Dynamic Blog Grid -->
<section class="blog-grid-section">
    <div class="container">
        <h2>Latest from Our Blog</h2>
        <div class="blog-grid" id="blog-grid">
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 6,
                'post_status' => 'publish'
            ));
            foreach ($recent_posts as $post): ?>
                <article class="blog-card" data-categories="<?php echo get_the_category_list(',', '', $post['ID']); ?>">
                    <?php if (has_post_thumbnail($post['ID'])): ?>
                        <div class="post-thumbnail">
                            <?php echo get_the_post_thumbnail($post['ID'], 'large'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="post-content">
                        <h3><?php echo $post['post_title']; ?></h3>
                        <p><?php echo wp_trim_words($post['post_excerpt'] ?: $post['post_content'], 20); ?></p>
                        <a href="<?php echo get_permalink($post['ID']); ?>" class="read-more">Read More</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <button id="load-more" class="load-more-btn">Load More Articles</button>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <h2>Join Our Wellness Community</h2>
        <p>Get free resources, weekly insights, and support</p>
        <div class="newsletter-form">
            <!-- Add your MailerLite form here -->
            <form action="#" method="post">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>