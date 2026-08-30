<x-layout class="landing-page">
    <x-slot:title>to-day | Todo List</x-slot:title>

    <!-- LANDING NAVIGATION START
         Landing-specific classes (.landing-*) keep these anchors clear of the
         task page's SPA navigation handling, which intercepts the task
         navbar's own link selectors. The menu is fully usable without
         JavaScript: the toggle only appears once landing.js marks the body
         with .landing-js. -->
    <header class="landing-navbar">
        <div class="landing-navbar-inner">
            <a href="{{ route('home') }}" class="landing-logo">to<span class="landing-logo-accent">day</span></a>

            <button class="landing-nav-toggle" type="button" aria-expanded="false" aria-controls="landingNavPanel">
                <span class="landing-nav-toggle-icon" aria-hidden="true">
                    <span class="landing-nav-toggle-bar"></span>
                    <span class="landing-nav-toggle-bar"></span>
                    <span class="landing-nav-toggle-bar"></span>
                </span>
                <span class="landing-nav-toggle-text">Menu</span>
            </button>

            <nav class="landing-nav" id="landingNavPanel" aria-label="Landing page sections">
                <ul class="landing-nav-links">
                    <li><a href="#benefits" class="landing-nav-link">Benefits</a></li>
                    <li><a href="#preview" class="landing-nav-link">Preview</a></li>
                    <li><a href="#how-it-works" class="landing-nav-link">How It Works</a></li>
                    <li><a href="#about" class="landing-nav-link">About</a></li>
                </ul>
                <div class="landing-nav-actions">
                    @guest
                        <a href="{{ route('logingo') }}" class="landing-nav-link landing-nav-login">Log In</a>
                        <a href="{{ route('signupgo') }}" class="landing-button landing-button--primary">Get Started</a>
                    @else
                        <a href="{{ route('index') }}" class="landing-button landing-button--primary">Open My Tasks</a>
                    @endguest
                </div>
            </nav>
        </div>
    </header>
    <!-- LANDING NAVIGATION END -->

    <main class="landing-main">

        <!-- HERO SECTION START -->
        <section class="hero-section">
            {{-- Decorative star field: twinkling stars are generated here by JavaScript --}}
            <div class="hero-star-field" aria-hidden="true"></div>

            {{-- Decorative layered mountain silhouettes (back to front): far, middle, foreground --}}
            <div class="hero-mountain-scene" aria-hidden="true">
                <div class="hero-ridge hero-ridge--far">
                    <svg viewBox="0 0 1440 320" preserveAspectRatio="none" focusable="false" aria-hidden="true">
                        <path d="M0,320 L0,236 C 130,220 240,180 340,156 C 420,138 500,152 590,186 C 680,214 760,214 850,186 C 940,152 1020,138 1100,156 C 1200,180 1310,220 1440,236 L1440,320 Z"></path>
                    </svg>
                </div>
                <div class="hero-ridge hero-ridge--middle">
                    <svg viewBox="0 0 1440 320" preserveAspectRatio="none" focusable="false" aria-hidden="true">
                        <path d="M0,320 L0,258 C 170,246 330,222 490,200 C 610,184 720,180 830,188 C 950,198 1110,224 1270,244 C 1330,250 1390,255 1440,258 L1440,320 Z"></path>
                    </svg>
                </div>
                <div class="hero-ridge hero-ridge--foreground">
                    <svg viewBox="0 0 1440 320" preserveAspectRatio="none" focusable="false" aria-hidden="true">
                        <path d="M0,320 L0,244 C 210,233 390,210 530,172 C 620,148 672,124 720,116 C 768,124 820,148 910,172 C 1050,210 1230,233 1440,244 L1440,320 Z"></path>
                    </svg>
                </div>
            </div>

            <div class="hero-content">
                <h1 class="hero-title">
                    Conquer Your Day, <span class="hero-title-accent">Simply</span>.
                </h1>
                <p class="hero-subtitle">
                    Focus, organize, and achieve with to-day, your personal task manager.
                </p>
                @guest
                    <a href="{{ route('signupgo') }}" class="cta-button" id="heroCtaButton">Let's Get Started</a>
                @else
                    <a href="{{ route('index') }}" class="cta-button" id="heroCtaButton">Open My Tasks</a>
                @endguest
                <p class="hero-cue">
                    <a href="#how-it-works" class="hero-cue-link">
                        See how it works
                        <span class="hero-cue-arrow" aria-hidden="true">&darr;</span>
                    </a>
                </p>
            </div>
        </section>
        <!-- HERO SECTION END -->


        <!-- VALUE TRANSITION SECTION START
             The lavender/mauve bridge between the atmospheric dawn hero and
             the practical, warm off-white product sections. -->
        <section class="landing-transition" aria-labelledby="landingTransitionTitle">
            <div class="landing-container landing-transition-content">
                <p class="landing-eyebrow landing-eyebrow--on-dusk">A calmer way to plan</p>
                <h2 class="landing-transition-title" id="landingTransitionTitle">
                    Turn scattered to-dos into one clear view
                </h2>
                <p class="landing-transition-text">
                    to-day gathers the responsibilities floating around your head into a single,
                    manageable list. See what is due today, keep everything else within reach,
                    and start each morning with a plan instead of a pile.
                </p>
            </div>
        </section>
        <!-- VALUE TRANSITION SECTION END -->


        <!-- BENEFITS SECTION START -->
        <section class="landing-section landing-benefits" id="benefits" aria-labelledby="landingBenefitsTitle">
            <div class="landing-container">
                <p class="landing-eyebrow">What to-day does</p>
                <h2 class="landing-section-title" id="landingBenefitsTitle">
                    Three things, done <span class="landing-title-accent">well</span>
                </h2>
                <p class="landing-section-subtitle">
                    No dashboards, no automation, no noise — just the essentials of keeping
                    a personal task list.
                </p>

                <div class="landing-benefits-grid">
                    <article class="landing-benefit-card landing-reveal">
                        <div class="landing-benefit-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" focusable="false">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </div>
                        <h3 class="landing-benefit-title">Capture Without Friction</h3>
                        <p class="landing-benefit-text">
                            Add a task in seconds: a name is all it takes, with an optional due
                            date, time, and priority when you want more structure. Get it out of
                            your head before it slips away.
                        </p>
                    </article>

                    <article class="landing-benefit-card landing-reveal">
                        <div class="landing-benefit-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" focusable="false">
                                <circle cx="12" cy="12" r="5"></circle>
                                <line x1="12" y1="1" x2="12" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="23"></line>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                <line x1="1" y1="12" x2="3" y2="12"></line>
                                <line x1="21" y1="12" x2="23" y2="12"></line>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                            </svg>
                        </div>
                        <h3 class="landing-benefit-title">Focus on Today</h3>
                        <p class="landing-benefit-text">
                            Switch between Today and All views to narrow your attention to what is
                            due now while everything else stays safely listed. Low, medium, and
                            high priorities keep the important items easy to spot.
                        </p>
                    </article>

                    <article class="landing-benefit-card landing-reveal">
                        <div class="landing-benefit-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" focusable="false">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <h3 class="landing-benefit-title">Finish With Clarity</h3>
                        <p class="landing-benefit-text">
                            Check tasks off as you complete them, edit the details when plans
                            shift, and delete what no longer matters. Your list stays honest,
                            current, and uncluttered.
                        </p>
                    </article>
                </div>
            </div>
        </section>
        <!-- BENEFITS SECTION END -->


        <!-- PREVIEW SECTION START
             A static, non-interactive illustration of the real task interface.
             Every control shown maps to a supported concept (Today/All views,
             task name, due date/time, priority, completion, edit, delete), and
             nothing here calls an API or touches account data. -->
        <section class="landing-section landing-preview" id="preview" aria-labelledby="landingPreviewTitle">
            <div class="landing-container">
                <p class="landing-eyebrow">Inside the app</p>
                <h2 class="landing-section-title" id="landingPreviewTitle">
                    A quiet, focused <span class="landing-title-accent">task list</span>
                </h2>
                <p class="landing-section-subtitle">
                    This is what working with to-day looks like: one list, clear priorities,
                    and room to breathe.
                </p>

                <figure class="landing-preview-figure landing-reveal">
                    {{-- The mock is decorative sample data; hide it from assistive
                         technology and let the caption carry the meaning. --}}
                    <div class="landing-preview-mock" aria-hidden="true">
                        <div class="landing-preview-window">
                            <div class="landing-preview-titlebar">
                                <span class="landing-preview-dot"></span>
                                <span class="landing-preview-dot"></span>
                                <span class="landing-preview-dot"></span>
                                <span class="landing-preview-app">to-day</span>
                            </div>
                            <div class="landing-preview-body">
                                <div class="landing-preview-head">
                                    <p class="landing-preview-heading">
                                        Today's Focus<span class="landing-preview-heading-dot">.</span>
                                    </p>
                                    <div class="landing-preview-views">
                                        <span class="landing-preview-view is-active">Today</span>
                                        <span class="landing-preview-view">All</span>
                                    </div>
                                </div>

                                <div class="landing-preview-add">
                                    <span class="landing-preview-add-field">e.g., Finish project proposal by 5 PM</span>
                                    <span class="landing-preview-add-button">Add Task</span>
                                </div>

                                <ul class="landing-preview-list">
                                    <li class="landing-preview-task landing-preview-task--high">
                                        <span class="landing-preview-priority-bar"></span>
                                        <span class="landing-preview-checkbox"></span>
                                        <span class="landing-preview-task-main">
                                            <span class="landing-preview-task-name">Finish project proposal</span>
                                            <span class="landing-preview-task-meta">
                                                <span class="landing-preview-due">
                                                    <i class="fas fa-calendar-alt"></i> Today &middot; 5:00 PM
                                                </span>
                                                <span class="landing-preview-priority landing-preview-priority--high">high priority</span>
                                            </span>
                                        </span>
                                        <span class="landing-preview-actions">
                                            <span class="landing-preview-action"><i class="fas fa-pencil-alt"></i></span>
                                            <span class="landing-preview-action"><i class="fas fa-trash-alt"></i></span>
                                        </span>
                                    </li>

                                    <li class="landing-preview-task landing-preview-task--medium">
                                        <span class="landing-preview-priority-bar"></span>
                                        <span class="landing-preview-checkbox"></span>
                                        <span class="landing-preview-task-main">
                                            <span class="landing-preview-task-name">Send the invoice to Sam</span>
                                            <span class="landing-preview-task-meta">
                                                <span class="landing-preview-due">
                                                    <i class="fas fa-calendar-alt"></i> Today &middot; 11:30 AM
                                                </span>
                                                <span class="landing-preview-priority landing-preview-priority--medium">medium priority</span>
                                            </span>
                                        </span>
                                        <span class="landing-preview-actions">
                                            <span class="landing-preview-action"><i class="fas fa-pencil-alt"></i></span>
                                            <span class="landing-preview-action"><i class="fas fa-trash-alt"></i></span>
                                        </span>
                                    </li>

                                    <li class="landing-preview-task landing-preview-task--low is-completed">
                                        <span class="landing-preview-priority-bar"></span>
                                        <span class="landing-preview-checkbox is-checked">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="landing-preview-task-main">
                                            <span class="landing-preview-task-name">Water the plants</span>
                                            <span class="landing-preview-task-meta">
                                                <span class="landing-preview-due">
                                                    <i class="fas fa-calendar-alt"></i> Today &middot; 9:00 AM
                                                </span>
                                            </span>
                                        </span>
                                        <span class="landing-preview-actions">
                                            <span class="landing-preview-action"><i class="fas fa-pencil-alt"></i></span>
                                            <span class="landing-preview-action"><i class="fas fa-trash-alt"></i></span>
                                        </span>
                                    </li>

                                    <li class="landing-preview-task landing-preview-task--medium">
                                        <span class="landing-preview-priority-bar"></span>
                                        <span class="landing-preview-checkbox"></span>
                                        <span class="landing-preview-task-main">
                                            <span class="landing-preview-task-name">Plan Friday's review</span>
                                            <span class="landing-preview-task-meta">
                                                <span class="landing-preview-due">
                                                    <i class="fas fa-calendar-alt"></i> No due date
                                                </span>
                                                <span class="landing-preview-priority landing-preview-priority--medium">medium priority</span>
                                            </span>
                                        </span>
                                        <span class="landing-preview-actions">
                                            <span class="landing-preview-action"><i class="fas fa-pencil-alt"></i></span>
                                            <span class="landing-preview-action"><i class="fas fa-trash-alt"></i></span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <figcaption class="landing-preview-caption">
                        <span class="landing-preview-badge">Example preview</span>
                        <span>Sample tasks shown for illustration — your real list lives in your own account.</span>
                    </figcaption>
                </figure>
            </div>
        </section>
        <!-- PREVIEW SECTION END -->


        <!-- HOW IT WORKS SECTION START -->
        <section class="landing-section landing-workflow" id="how-it-works" aria-labelledby="landingWorkflowTitle">
            <div class="landing-container">
                <p class="landing-eyebrow">How it works</p>
                <h2 class="landing-section-title" id="landingWorkflowTitle">
                    Three steps to a <span class="landing-title-accent">clearer day</span>
                </h2>
                <p class="landing-section-subtitle">
                    The whole workflow in under a minute — capture, focus, finish.
                </p>

                <ol class="landing-workflow-steps">
                    <li class="landing-workflow-step landing-reveal">
                        <span class="landing-workflow-number" aria-hidden="true">1</span>
                        <h3 class="landing-workflow-step-title">Capture it</h3>
                        <p class="landing-workflow-step-text">
                            Write the task down the moment it comes to mind. A name is enough;
                            add a due date, time, and priority whenever you want more structure.
                        </p>
                    </li>
                    <li class="landing-workflow-step landing-reveal">
                        <span class="landing-workflow-number" aria-hidden="true">2</span>
                        <h3 class="landing-workflow-step-title">Shape your day</h3>
                        <p class="landing-workflow-step-text">
                            Open the Today view for what is due right now, or All for the full
                            picture. Priorities make it obvious where to start.
                        </p>
                    </li>
                    <li class="landing-workflow-step landing-reveal">
                        <span class="landing-workflow-number" aria-hidden="true">3</span>
                        <h3 class="landing-workflow-step-title">Finish and clear</h3>
                        <p class="landing-workflow-step-text">
                            Check tasks off when they are done, edit them when plans change, and
                            delete what is no longer needed. Momentum, kept.
                        </p>
                    </li>
                </ol>
            </div>
        </section>
        <!-- HOW IT WORKS SECTION END -->


        <!-- ABOUT / PURPOSE SECTION START -->
        <section class="landing-section landing-purpose" id="about" aria-labelledby="landingPurposeTitle">
            <div class="landing-container landing-purpose-content">
                <p class="landing-eyebrow">Why to-day exists</p>
                <h2 class="landing-section-title" id="landingPurposeTitle">
                    Built for calm, steady <span class="landing-title-accent">progress</span>
                </h2>
                <p class="landing-purpose-text">
                    to-day started with a simple belief: powerful tools don't need to be
                    complicated. A short, honest list beats an elaborate system — less time
                    organizing, more time doing. That is mindful productivity: progress
                    without pressure.
                </p>
                <ul class="landing-purpose-principles">
                    <li class="landing-purpose-principle">
                        <h3 class="landing-purpose-principle-title">Simple by design</h3>
                        <p class="landing-purpose-principle-text">Only the fields a task truly needs.</p>
                    </li>
                    <li class="landing-purpose-principle">
                        <h3 class="landing-purpose-principle-title">Focus over features</h3>
                        <p class="landing-purpose-principle-text">One list, two views, zero noise.</p>
                    </li>
                    <li class="landing-purpose-principle">
                        <h3 class="landing-purpose-principle-title">Progress without pressure</h3>
                        <p class="landing-purpose-principle-text">No streaks, no scores — just done or not yet.</p>
                    </li>
                </ul>
            </div>
        </section>
        <!-- ABOUT / PURPOSE SECTION END -->


        <!-- FINAL CTA SECTION START -->
        <section class="landing-final-cta" aria-labelledby="landingFinalCtaTitle">
            <div class="landing-container landing-final-cta-content">
                @guest
                    <h2 class="landing-final-cta-title" id="landingFinalCtaTitle">
                        Ready to meet your day?
                    </h2>
                    <p class="landing-final-cta-text">
                        Create your account and start with a single task — the sunrise is yours from there.
                    </p>
                    <div class="landing-final-cta-actions">
                        <a href="{{ route('signupgo') }}" class="cta-button landing-final-cta-primary">Let's Get Started</a>
                        <a href="{{ route('logingo') }}" class="landing-button landing-button--ghost">I already have an account</a>
                    </div>
                @else
                    <h2 class="landing-final-cta-title" id="landingFinalCtaTitle">
                        Your list is waiting.
                    </h2>
                    <p class="landing-final-cta-text">
                        Pick up right where you left off — today's tasks are one click away.
                    </p>
                    <div class="landing-final-cta-actions">
                        <a href="{{ route('index') }}" class="cta-button landing-final-cta-primary">Open My Tasks</a>
                    </div>
                @endguest
            </div>
        </section>
        <!-- FINAL CTA SECTION END -->

    </main>


    <!-- FOOTER START -->
    <footer class="landing-footer">
        <div class="landing-footer-inner">
            <a href="{{ route('home') }}" class="landing-footer-logo">to<span class="landing-footer-logo-accent">day</span></a>
            <p class="landing-footer-tagline">A simple personal task manager — focus, organize, and achieve.</p>
            <p class="landing-footer-copyright">&copy; <span id="currentYear">{{ now()->year }}</span> to-day. All rights reserved.</p>
        </div>
    </footer>
    <!-- FOOTER END -->
</x-layout>
