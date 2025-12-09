// ProTeach - Interactive JavaScript

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Validate registration form
    const registerForm = document.querySelector('form[action="register.php"]');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long!');
                return false;
            }
        });
    }
    
    // Add smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 500);
        }, 5000);
    });
    
    // Animate progress bars
    const progressBars = document.querySelectorAll('.progress-bar-fill');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 100);
    });
    
    // Assessment timer (optional feature)
    const assessmentForm = document.getElementById('assessmentForm');
    if (assessmentForm) {
        let startTime = Date.now();
        
        assessmentForm.addEventListener('submit', function() {
            const duration = Math.floor((Date.now() - startTime) / 1000);
            console.log('Assessment completed in ' + duration + ' seconds');
        });
    }
    
    // Responsive navigation toggle for mobile
    const navToggle = document.createElement('button');
    navToggle.classList.add('nav-toggle');
    navToggle.innerHTML = '☰';
    navToggle.style.display = 'none';
    navToggle.style.background = 'none';
    navToggle.style.border = 'none';
    navToggle.style.fontSize = '1.5rem';
    navToggle.style.cursor = 'pointer';
    navToggle.style.color = 'var(--primary-color)';
    
    const nav = document.querySelector('nav .container');
    const navLinks = document.querySelector('.nav-links');
    
    if (nav && navLinks) {
        nav.insertBefore(navToggle, navLinks);
        
        navToggle.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
        
        // Show/hide toggle button based on screen size
        function checkScreenSize() {
            if (window.innerWidth <= 768) {
                navToggle.style.display = 'block';
                navLinks.style.display = navLinks.classList.contains('active') ? 'flex' : 'none';
            } else {
                navToggle.style.display = 'none';
                navLinks.style.display = 'flex';
            }
        }
        
        window.addEventListener('resize', checkScreenSize);
        checkScreenSize();
    }
});

// Helper function to format dates
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
}

// Helper function to calculate progress percentage
function calculateProgress(completed, total) {
    if (total === 0) return 0;
    return Math.round((completed / total) * 100);
}
