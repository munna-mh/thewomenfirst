// Interactive Category Filtering
document.addEventListener('DOMContentLoaded', function() {
    // Category Filtering
    const filterButtons = document.querySelectorAll('.filter-btn');
    const blogGrid = document.getElementById('blog-grid');
    const loadMoreBtn = document.getElementById('load-more');
    
    let currentPage = 1;
    let currentCategory = 'all';
    
    // Filter button clicks
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter posts
            currentCategory = this.dataset.category;
            currentPage = 1;
            filterPosts(currentCategory);
        });
    });
    
    function filterPosts(category) {
        const posts = document.querySelectorAll('.blog-card');
        
        posts.forEach(post => {
            if (category === 'all') {
                post.style.display = 'block';
            } else {
                const postCategories = post.dataset.categories.toLowerCase();
                if (postCategories.includes(category)) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            }
        });
    }
    
    // Load More functionality
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            currentPage++;
            loadMorePosts(currentPage, currentCategory);
        });
    }
    
    function loadMorePosts(page, category) {
        // AJAX call to load more posts
        const data = new FormData();
        data.append('action', 'load_more_posts');
        data.append('page', page);
        data.append('category', category);
        data.append('nonce', ajax_object.nonce);
        
        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(html => {
            if (html.trim() === '') {
                loadMoreBtn.style.display = 'none';
                return;
            }
            blogGrid.innerHTML += html;
        })
        .catch(error => {
            console.error('Error loading posts:', error);
        });
    }
    
    // Sticky header on scroll
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.womenfirst-header');
        if (window.scrollY > 100) {
            header.style.background = 'rgba(248, 245, 240, 0.95)';
            header.style.backdropFilter = 'blur(10px)';
        } else {
            header.style.background = 'var(--ivory)';
            header.style.backdropFilter = 'none';
        }
    });
});