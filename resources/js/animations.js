// --- Stargazing hero: twinkling star field ---
// Populates the dedicated .hero-star-field container with two kinds of stars:
//   - many small, dim "ambient" stars, and
//   - a sparse set of brighter, slower "featured" stars.
// All appearance (color, glow, animation) lives in CSS; this script only
// supplies per-star variation through CSS custom properties. It exits quietly
// on pages without a star field and guards against running twice.
const heroStarField = document.querySelector(".hero-star-field");

if (heroStarField && !heroStarField.dataset.starsGenerated) {
    heroStarField.dataset.starsGenerated = "true";

    // Keep density proportional to the viewport so small screens stay calm and
    // performant.
    const viewportWidth = window.innerWidth || 1200;
    const ambientCount = Math.max(
        50,
        Math.min(130, Math.round(viewportWidth / 11))
    );
    const featuredCount = Math.max(
        4,
        Math.min(9, Math.round(viewportWidth / 180))
    );

    // A soft rectangular zone behind the main copy where stars are thinned out
    // so the heading, subtitle, and CTA stay the focus.
    const calmZone = { topMin: 12, topMax: 62, leftMin: 22, leftMax: 78 };
    const inCalmZone = (top, left) =>
        top >= calmZone.topMin &&
        top <= calmZone.topMax &&
        left >= calmZone.leftMin &&
        left <= calmZone.leftMax;

    // Dawn-aware vertical falloff: stars are brightest in the dark upper sky
    // and fade toward the warm peach horizon. `top` is in percent (2-70).
    const dawnFalloff = (top) => {
        const skyTop = 2;
        const skyBottom = 70;
        const depth = (top - skyTop) / (skyBottom - skyTop); // 0 at top, 1 at bottom
        return Math.max(0.25, 1 - depth * 0.75);
    };

    // Pick a position. Featured stars are restricted to the darker upper sky
    // (top ~2-42%). Ambient stars use an upper-biased distribution so the
    // dawn gradient has more stars above and fewer, fainter stars near the
    // horizon — a smooth falloff, not a hard cutoff. Stars are kept inside
    // safe margins so their glow is not clipped, and out of the mountain band.
    const pickPosition = (isFeatured) => {
        let top = 0;
        let left = 0;
        for (let attempt = 0; attempt < 2; attempt++) {
            if (isFeatured) {
                // Upper ~40-42% only, biased toward the very top.
                top = 2 + 40 * Math.pow(Math.random(), 1.3);
            } else {
                // Upper-biased: Math.pow skews the uniform distribution toward 0,
                // so more ambient stars land in the upper sky.
                top = 2 + 68 * Math.pow(Math.random(), 1.5);
            }
            left = 1 + Math.random() * 98; // 1% - 99% from the left
            if (!inCalmZone(top, left)) break;
        }
        return { top, left };
    };

    const randomBetween = (min, max) => min + Math.random() * (max - min);

    const createStar = (variant) => {
        const star = document.createElement("div");
        star.classList.add("star", `star--${variant}`);

        const isFeatured = variant === "featured";
        const { top, left } = pickPosition(isFeatured);
        const falloff = dawnFalloff(top);

        // Ambient stars are tiny; featured stars are a little larger.
        const size = isFeatured ? randomBetween(4, 7) : randomBetween(1, 3);

        // Timing: ambient stars twinkle on a short, varied cycle; featured
        // stars twinkle less frequently on a much longer cycle. A negative
        // delay starts each star part-way through its cycle so the field is
        // desynchronized and never flashes at full brightness on load.
        const duration = isFeatured
            ? randomBetween(7, 12)
            : randomBetween(3, 7);
        const delay = -Math.random() * duration;

        // Opacity and glow are scaled by vertical falloff so lower stars near
        // the warm horizon are progressively dimmer and less glowy.
        const rawBaseOpacity = isFeatured
            ? randomBetween(0.15, 0.35)
            : randomBetween(0.1, 0.35);
        const rawPeakOpacity = isFeatured
            ? randomBetween(0.85, 1)
            : randomBetween(0.5, 0.9);
        const rawGlow = isFeatured ? randomBetween(4, 7) : randomBetween(2, 4);
        const rawGlowAlpha = isFeatured
            ? randomBetween(0.5, 0.75)
            : randomBetween(0.25, 0.5);
        const baseOpacity = rawBaseOpacity * falloff;
        const peakOpacity = rawPeakOpacity * (0.55 + 0.45 * falloff);
        const glow = rawGlow * (0.6 + 0.4 * falloff);
        const glowAlpha = rawGlowAlpha * falloff;

        star.style.setProperty("--star-top", `${top.toFixed(2)}%`);
        star.style.setProperty("--star-left", `${left.toFixed(2)}%`);
        star.style.setProperty("--star-size", `${size.toFixed(2)}px`);
        star.style.setProperty("--star-duration", `${duration.toFixed(2)}s`);
        star.style.setProperty("--star-delay", `${delay.toFixed(2)}s`);
        star.style.setProperty("--star-base-opacity", baseOpacity.toFixed(2));
        star.style.setProperty("--star-peak-opacity", peakOpacity.toFixed(2));
        star.style.setProperty("--star-glow", `${glow.toFixed(1)}px`);
        star.style.setProperty("--star-glow-alpha", glowAlpha.toFixed(2));

        return star;
    };

    // Use a fragment so all stars are inserted in a single DOM write.
    const fragment = document.createDocumentFragment();
    for (let i = 0; i < ambientCount; i++) {
        fragment.appendChild(createStar("ambient"));
    }
    for (let i = 0; i < featuredCount; i++) {
        fragment.appendChild(createStar("featured"));
    }
    heroStarField.appendChild(fragment);
}
// --- End of stargazing hero star field ---
