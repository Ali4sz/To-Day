// --- Landing-page behavior (page-scoped) ---
// This module only runs on the landing page (body.landing-page). It provides:
//   1. An accessible mobile navigation toggle (progressive enhancement — the
//      full link list stays visible and usable when JavaScript is disabled).
//   2. Optional content reveals that never hide content from no-JS or
//      reduced-motion users.
// It deliberately contains no task SPA logic and never intercepts anchor
// navigation, so landing anchors scroll natively to their sections.

document.addEventListener("DOMContentLoaded", () => {
    const landingBody = document.body.classList.contains("landing-page")
        ? document.body
        : null;
    if (!landingBody) return;

    // Mark the page as JS-enabled. CSS uses this hook so the collapsible
    // menu behavior only applies when the toggle can actually work.
    landingBody.classList.add("landing-js");

    initLandingNav();
    initLandingReveals();
});

function initLandingNav() {
    const toggle = document.querySelector(".landing-nav-toggle");
    const panel = document.getElementById("landingNavPanel");
    if (!toggle || !panel) return;

    const isOpen = () => toggle.getAttribute("aria-expanded") === "true";

    const setOpen = (open) => {
        toggle.setAttribute("aria-expanded", String(open));
        panel.classList.toggle("is-open", open);
    };

    // Toggle the menu.
    toggle.addEventListener("click", () => {
        setOpen(!isOpen());
    });

    // Close after choosing a destination so the menu never covers the page.
    panel.addEventListener("click", (event) => {
        if (event.target.closest("a")) {
            setOpen(false);
        }
    });

    // Escape closes the menu and returns focus to the toggle.
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && isOpen()) {
            setOpen(false);
            toggle.focus();
        }
    });

    // Clicking outside the navbar closes the menu.
    document.addEventListener("click", (event) => {
        if (isOpen() && !event.target.closest(".landing-navbar")) {
            setOpen(false);
        }
    });
}

function initLandingReveals() {
    const targets = document.querySelectorAll(".landing-reveal");
    if (targets.length === 0) return;

    // Content-first: under reduced motion (or without IntersectionObserver
    // support) everything simply stays visible.
    const reduceMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;
    if (reduceMotion || !("IntersectionObserver" in window)) return;

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-revealed");
                    obs.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15, rootMargin: "0px 0px -40px 0px" }
    );

    targets.forEach((element) => observer.observe(element));
}
