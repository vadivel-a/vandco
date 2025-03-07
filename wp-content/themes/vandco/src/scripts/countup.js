// Import Anime.js after installation via npm
import anime from 'animejs';

// Function to animate the counter element
function animateCounter(counter) {
  // Get the target value from the innerText and parse it as an integer
  const targetValue = parseInt(counter.innerText, 10); // Parse it as an integer
  const text = counter.innerText.trim(); // Get the innerText and trim any extra spaces
  
  // Extract the symbol by checking for the last non-numeric character
  let symbol = '';
  for (let i = text.length - 1; i >= 0; i--) {
    const char = text.charAt(i);
    if (isNaN(char)) {  // If we encounter a non-numeric character
      symbol = char;
      break;
    }
  }

  // Animate the count-up
  anime({
    targets: counter,
    innerHTML: [0, targetValue],  // Count from 0 to the target value
    round: 1, // Round to integer
    duration: 5000, // Duration in milliseconds (5 seconds)
    easing: 'easeInOutQuad', // Smooth easing
    update: function(anim) {
      // On every animation frame, always add the symbol
      const currentValue = parseFloat(anim.animations[0].currentValue); // Ensure numeric value
      counter.innerHTML = `${currentValue.toFixed(0)}${symbol}`;
    }
  });
}

// Set up Intersection Observer
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      // When the counter section is in view, animate all counters within the section
      const counters = entry.target.querySelectorAll('.counter');
      counters.forEach(counter => {
        animateCounter(counter);
      });
      // Stop observing the element after animation starts
      observer.unobserve(entry.target);
    }
  });
}, {
  threshold: 0.5 // Trigger when 50% of the section is visible
});

// Start observing all counter sections
const counterSections = document.querySelectorAll('.counter-section');
counterSections.forEach(section => {
  observer.observe(section);
});
