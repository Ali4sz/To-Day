// --- Existing JavaScript for number count-up (metric-value) ---
const metricValues = document.querySelectorAll(".metric-value");
const heroSection = document.querySelector(".hero-section");
const animatedElements = document.querySelectorAll(
    ".benefit-card, .chart-card, .about-block"
);
if (metricValues.length > 0) {
    // Check if elements exist
    const animateValue = (element, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min(
                (timestamp - startTimestamp) / duration,
                1
            );
            element.textContent = Math.floor(
                progress * (end - start) + start
            ).toLocaleString();
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    const observerOptionsCountUp = {
        root: null,
        rootMargin: "0px",
        threshold: 0.1,
    };

    const observerCallbackCountUp = (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const targetValue = parseInt(
                    element.getAttribute("data-target"),
                    10
                );
                if (
                    !isNaN(targetValue) &&
                    !element.classList.contains("has-animated")
                ) {
                    // Avoid re-animating
                    animateValue(element, 0, targetValue, 2000);
                    element.classList.add("has-animated"); // Mark as animated
                }
                // Optionally unobserve if you only want it to animate once per page load
                // and not if it scrolls out and back in (unless page reloads)
                // For numbers, usually once is enough.
                observer.unobserve(element);
            }
        });
    };

    const countUpObserver = new IntersectionObserver(
        observerCallbackCountUp,
        observerOptionsCountUp
    );

    metricValues.forEach((valueEl) => {
        valueEl.textContent = "0";
        countUpObserver.observe(valueEl);
    });
}
// --- End of number count-up ---

// --- NEW: IntersectionObserver for fade-in card animations ---
const animatedCards = document.querySelectorAll(".benefit-card, .chart-card");

if (animatedCards.length > 0) {
    // Check if elements exist
    const cardObserverOptions = {
        root: null, // Animate relative to the viewport
        rootMargin: "0px",
        threshold: 0.1, // Trigger when 10% of the card is visible
    };

    const cardObserverCallback = (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                observer.unobserve(entry.target); // Stop observing once animation is triggered
            }
        });
    };

    const fadeInCardObserver = new IntersectionObserver(
        cardObserverCallback,
        cardObserverOptions
    );

    animatedCards.forEach((card) => {
        fadeInCardObserver.observe(card);
    });
}

if (animatedElements.length > 0) {
    const elementObserverOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.1, // Trigger when 10% of the element is visible
    };

    const elementObserverCallback = (entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                observer.unobserve(entry.target); // Stop observing once animation is triggered
            }
        });
    };

    const fadeInElementObserver = new IntersectionObserver(
        elementObserverCallback,
        elementObserverOptions
    );

    animatedElements.forEach((el) => {
        fadeInElementObserver.observe(el);
    });
}
// --- End of fade-in card animations ---

if (!heroSection) {
    console.warn("Hero section not found for star animation.");
} else {
    const starBaseColor =
        getComputedStyle(document.documentElement)
            .getPropertyValue("--star-color")
            .trim() ||
        getComputedStyle(document.documentElement)
            .getPropertyValue("--complementary-color")
            .trim() ||
        "#D4AAFF"; // Fallback star color
    const starGlow =
        getComputedStyle(document.documentElement)
            .getPropertyValue("--star-glow-color")
            .trim() ||
        `rgba(${
            starBaseColor.includes("rgba")
                ? starBaseColor.match(/\d+/g).slice(0, 3).join(",")
                : "220,200,255"
        }, 0.7)`;

    const numberOfStars = 70; // Adjust for more or fewer stars
    const starColor =
        getComputedStyle(document.documentElement)
            .getPropertyValue("--complementary-color")
            .trim() || "rgba(220, 220, 255, 0.7)";
    const starGlowColor = `rgba(${
        starColor.includes("rgba")
            ? starColor.match(/\d+/g).slice(0, 3).join(",")
            : "230,230,255"
    }, 0.5)`;

    for (let i = 0; i < numberOfStars; i++) {
        const star = document.createElement("div");
        star.classList.add("star");

        // Random size for stars (e.g., 1px to 3px diameter)
        const size = Math.random() * 4 + 4;
        star.style.width = `${size}px`;
        star.style.height = `${size}px`;

        // Random position within the hero section
        star.style.top = `${Math.random() * 100}%`;
        star.style.left = `${Math.random() * 100}%`;

        // Random animation delay and duration for a more natural, less synchronized twinkle
        star.style.animationDelay = `${Math.random() * 6}s`; // Stagger start times up to 5s
        star.style.animationDuration = `${Math.random() * 3 + 4}s`; // Duration between 3s and 6s

        // Set star colors dynamically if you want to override CSS variables from JS
        // or rely on the CSS variables (--star-color, --star-glow-color) defined above
        // star.style.backgroundColor = starColor; // Example if you want to force color from JS
        // star.style.boxShadow = `0 0 6px 1px ${starGlowColor}`; // Example

        heroSection.appendChild(star);
    }
}

// --- Existing JavaScript for bar chart animations (if any specific JS logic beyond CSS) ---
// Ensure these also respect visibility if needed, or rely on the .chart-card.is-visible
// for their parent container to be visible first.
// For example, the CSS animations for .simple-bar-chart .bar and .svg-bar-chart .bar-group rect
// will play once their parent .chart-card.is-visible is animated.
// You might not need extra JS observers for the bars themselves if the CSS is set up correctly.

// Example: If you had JS observer for simple bars (now likely redundant if parent animates)
// const simpleBars = document.querySelectorAll('.simple-bar-chart .bar');
// if (simpleBars.length > 0) {
//     const barObserver = new IntersectionObserver((entries, observer) => {
//         entries.forEach(entry => {
//             if (entry.isIntersecting && entry.target.closest('.chart-card.is-visible')) {
//                 entry.target.style.animationPlayState = 'running';
//                 observer.unobserve(entry.target);
//             }
//         });
//     }, { threshold: 0.2 });
//     simpleBars.forEach(bar => { /* barObserver.observe(bar); */ }); // Observe if needed
// }
