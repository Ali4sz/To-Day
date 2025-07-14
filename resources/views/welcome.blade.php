<x-layout>
    <x-slot:title>to-day | Todo List</x-slot:title>
    <header class="navbar">
        <div class="navbar-brand">
            <a href="{{ route('home') }}" class="logo">to<span class="logo-accent">day</span></a>
            </a>
        </div>
        <nav class="navbar-nav">
            <ul>
                {{-- @auth
                <li><a href="#" class="nav-link active" data-section="today">Today's Tasks</a></li>
                <li><a href="#" class="nav-link" data-section="all">All Tasks</a></li>
                <li><a href="#" class="nav-link" data-section="add">+ Add New</a></li>
                <li><a href="#" class="nav-link" data-section="settings">Settings</a></li>
                @endauth --}}
            </ul>
        </nav>
        <div class="navbar-extra">
            {{-- <div class="theme-toggle">
                ☀️
            </div> --}}
            <div class="navbar-brand">
                @auth
                <a href="{{ route('index') }}" class="logo">Back to <span class="logo-accent" >task!</span></a>
                @endauth
            </div>
        </div>
    </header>


    <!-- HERO SECTION START -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                Conquer Your Day, <span class="hero-title-accent">Simply</span>.
            </h1>
            <p class="hero-subtitle">
                Focus, organize, and achieve with to-day, your personal task manager.
            </p>
            <a href="{{ route('signupgo') }}" class="cta-button" id="heroCtaButton">Let's Get Started</a>
        </div>
        <!-- The glittering stars will be added here by JavaScript -->
    </section>
    <!-- HERO SECTION END -->


    <!-- WHY US SECTION START -->
    <section class="why-us-section">
        <div class="why-us-container">
            <h2 class="section-title">
                Why Choose <span class="why-us-logo-accent">To-Day</span>?
            </h2>
            <p class="section-subtitle">
                Discover a simpler path to productivity and peace of mind.
            </p>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <!-- Replace with an actual SVG or icon font in a real project -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-check-circle">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <h3 class="benefit-title">Effortless Organization</h3>
                    <p class="benefit-description">
                        Streamline your tasks with an intuitive interface designed for clarity and focus, not clutter.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <!-- Replace with an actual SVG or icon font -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-bar-chart-2">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                    </div>
                    <h3 class="benefit-title">Boost Your Productivity</h3>
                    <p class="benefit-description">
                        Prioritize effectively, manage your time wisely, and achieve your goals with greater ease.
                    </p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <!-- Replace with an actual SVG or icon font -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-smile">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                        </svg>
                    </div>
                    <h3 class="benefit-title">Find Your Calm</h3>
                    <p class="benefit-description">
                        Reduce mental overload and enjoy the tranquility of a well-managed day.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- WHY US SECTION END -->

    <!-- STATS SECTION START -->
    <section class="stats-section">
        <div class="stats-container">
            <h2 class="section-title">
                Our Impact <span class="stats-title-accent">By The Numbers</span>
            </h2>
            <p class="section-subtitle">
                See how To-Day is helping users achieve more, efficiently and calmly.
            </p>

            <div class="key-metrics-grid">
                <div class="metric-item">
                    <div class="metric-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="metric-value" data-target="12500">0</div>
                    <p class="metric-label">Happy Users</p>
                </div>
                <div class="metric-item">
                    <div class="metric-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-check-square">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                    </div>
                    <div class="metric-value" data-target="575000">0</div>
                    <p class="metric-label">Tasks Completed</p>
                </div>
                <div class="metric-item">
                    <div class="metric-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-award">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                    </div>
                    <div class="metric-value" data-target="98">0</div> <!-- Assuming percentage -->
                    <p class="metric-label">Satisfaction Rate (%)</p>
                </div>
            </div>

            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-title">Monthly Active Users</h3>
                    <div class="chart-placeholder simple-bar-chart">
                        <div class="bar" style="height: 30%;" data-value="Jan"></div>
                        <div class="bar" style="height: 45%;" data-value="Feb"></div>
                        <div class="bar" style="height: 60%;" data-value="Mar"></div>
                        <div class="bar" style="height: 70%;" data-value="Apr"></div>
                        <div class="bar" style="height: 85%;" data-value="May"></div>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">Task Completion (Quarterly)</h3>
                    <div class="chart-placeholder svg-bar-chart-container">
                        <svg width="100%" height="200" class="svg-bar-chart" aria-labelledby="taskCompletionTitle"
                            role="img">
                            <title id="taskCompletionTitle">Quarterly Task Completion Bar Chart</title>
                            <!-- Axes Lines -->
                            <line x1="10%" y1="90%" x2="90%" y2="90%" stroke="var(--neutral-light-gray, #ccc)"
                                stroke-width="1" />
                            <!-- X-axis -->
                            <line x1="10%" y1="10%" x2="10%" y2="90%" stroke="var(--neutral-light-gray, #ccc)"
                                stroke-width="1" />
                            <!-- Y-axis -->

                            <!-- Bars and Labels -->
                            <g class="bar-group">
                                <rect x="15%" y="50%" width="18%" height="40%"
                                    fill="var(--complementary-color-light, #e08f7d)" rx="3" ry="3"></rect>
                                <text x="24%" y="95%" text-anchor="middle" fill="#555" font-size="12px">Q1</text>
                            </g>
                            <g class="bar-group">
                                <rect x="40%" y="30%" width="18%" height="60%"
                                    fill="var(--complementary-color, #d57a66)" rx="3" ry="3">
                                </rect>
                                <text x="49%" y="95%" text-anchor="middle" fill="#555" font-size="12px">Q2</text>
                            </g>
                            <g class="bar-group">
                                <rect x="65%" y="15%" width="18%" height="75%"
                                    fill="var(--complementary-color-dark, #c06c56)" rx="3" ry="3"></rect>
                                <text x="74%" y="95%" text-anchor="middle" fill="#555" font-size="12px">Q3</text>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <p class="stats-footer-note">
                Illustrative data. For actual interactive charts, a charting library would be integrated.
            </p>
        </div>
    </section>
    <!-- STATS SECTION END -->

    <!-- ABOUT SECTION START -->
    <section class="about-section">
        <div class="about-container">
            <h2 class="section-title">
                The Heart of <span class="about-title-accent">To-Day</span>
            </h2>
            <p class="section-subtitle">
                Our principles, purpose, and the future we're building together.
            </p>

            <div class="about-content-wrapper">
                <!-- Motto Block -->
                <div class="about-block motto-block">
                    <div class="about-icon">
                        <!-- Icon: Feather Icons - Target -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-target">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </div>
                    <h3 class="about-block-title">Our Motto</h3>
                    <p class="about-block-text motto-statement">
                        "Conquer Your Day, <span class="hero-title-accent">Simply</span>."
                    </p>
                    <p class="about-block-description">
                        This isn't just a tagline; it's the core philosophy driving every feature and decision. We
                        believe powerful
                        tools don't need to be complex.
                    </p>
                </div>

                <!-- Goals Block -->
                <div class="about-block goals-block">
                    <div class="about-icon">
                        <!-- Icon: Feather Icons - Flag -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-flag">
                            <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path>
                            <line x1="4" y1="22" x2="4" y2="15"></line>
                        </svg>
                    </div>
                    <h3 class="about-block-title">Our Goals</h3>
                    <ul class="about-list">
                        <li>To provide an intuitive, delightful, and clutter-free task management experience for
                            everyone.</li>
                        <li>To empower individuals to achieve genuine focus, reduce daily overwhelm, and find joy in
                            their
                            accomplishments.</li>
                        <li>To continuously evolve by actively listening to our community and anticipating future
                            productivity needs
                            with innovative solutions.</li>
                    </ul>
                </div>

                <!-- Aspirations Block -->
                <div class="about-block aspirations-block">
                    <div class="about-icon">
                        <!-- Icon: Feather Icons - Trending Up -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trending-up">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                    </div>
                    <h3 class="about-block-title">Our Aspirations</h3>
                    <ul class="about-list">
                        <li>To become the most trusted and supportive companion in our users' pursuit of a balanced and
                            productive
                            life.</li>
                        <li>To foster a vibrant, inclusive community where users can share insights, find motivation,
                            and grow
                            together.</li>
                        <li>To inspire a mindful approach to productivity, championing well-being and personal
                            fulfillment alongside
                            achievement.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ABOUT SECTION END -->



    <!-- FOOTER START -->
    <footer class="site-footer">
        <p>© <span id="currentYear"></span> to-day. All Rights Reserved.</p>
        <p>Designed with <span class="footer-heart">♥</span> for productivity.</p>
    </footer>
    <!-- FOOTER END -->
</x-layout>