<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Compass: Navigate Your Budgeting Journey</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="SAD.jpg" type="image/x-icon"/>
</head>
<body>
    <header>
    <nav class="navbar">
        <div class="logo">
            <i class="fa fa-compass"></i>
            <span>FINANCIAL COMPASS</span>
        </div>
        <div class="nav-links">
            <a href="#hero" class="active">HOME</a>
            <a href="#features">FEATURES</a>
            <a href="#demo">DEMO</a>
        </div>
    </nav>
    </header>

    <main>
        <section id="hero" class="hero">
            <div class="hero-content">
                <h1>Your Budgeting Journey</h1>
                <p>Take control of your finances with our interactive planner. Start your path to financial freedom today!</p>
                <a href="login.php" class="cta-button">Start Budgeting Now</a>
            </div>
        </section>

        <section id="features" class="features">
            <h2>Why Choose Financial Compass?</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <h3>Interactive Planning</h3>
                    <p>Visualize your financial goals and track your progress with our intuitive interface.</p>
                </div>
                <div class="feature-card">
                    <h3>Smart Insights</h3>
                    <p>Receive personalized recommendations to optimize your budget and savings.</p>
                </div>
                <div class="feature-card">
                    <h3>Secure &amp; Private</h3>
                    <p>Your financial data is encrypted and never shared. Your privacy is our top priority.</p>
                </div>
                <div class="feature-card">
                    <h3>Multi-platform Sync</h3>
                    <p>Access your budget planner from any device, anytime, anywhere.</p>
                </div>
            </div>
        </section>

        <section id="demo" class="interactive-demo">
            <h2>Try Our Budget Calculator</h2>
            <div class="budget-calculator">
                <input type="number" id="income" placeholder="Enter your monthly income">
                <input type="number" id="expenses" placeholder="Enter your monthly expenses">
                <button onclick="calculateBudget()">Calculate Budget</button>
                <div id="result"></div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Financial Compass. All rights reserved.</p>
    </footer>

    <script>
// Function to update active link based on scroll position
function setActiveLink() {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-links a');
    
    let currentSection = "";

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        const scrollPosition = window.scrollY + 100; // Add a little offset to detect sections early

        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            currentSection = section.getAttribute('id');
        }
    });

    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href').includes(currentSection)) {
            link.classList.add('active');
        }
    });
}

// Update the active link when clicking
document.querySelectorAll('.nav-links a').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default anchor behavior
        const targetId = this.getAttribute('href').substring(1); // Get the target section ID
        document.querySelector(`#${targetId}`).scrollIntoView({
            behavior: 'smooth'
        });

        // Manually set the active link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.classList.remove('active');
        });
        this.classList.add('active');
    });
});

// Set active link on page load and scroll
window.addEventListener('scroll', setActiveLink);
window.addEventListener('DOMContentLoaded', setActiveLink);

    </script>
</body>
</html>