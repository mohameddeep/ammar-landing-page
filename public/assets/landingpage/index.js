// Translations object




function updateSliderDirection() {
  const isRTL = currentLang === 'ar';
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  if (prevBtn && nextBtn) {
    // Remove all position classes first
    prevBtn.classList.remove('left-4', 'right-4');
    nextBtn.classList.remove('left-4', 'right-4');
    
    // Add correct positions for RTL/LTR
    if (isRTL) {
      // RTL: prev on right, next on left
      prevBtn.classList.add('right-4');
      nextBtn.classList.add('left-4');
    } else {
      // LTR: prev on left, next on right
      prevBtn.classList.add('left-4');
      nextBtn.classList.add('right-4');
    }
  }
  
  // Update slide transitions for RTL/LTR
  const slides = document.querySelectorAll('.slide');
  slides.forEach(slide => {
    if (slide.classList.contains('active')) {
      // Keep active slide visible
      slide.style.transform = 'translateX(0)';
    } else if (slide.classList.contains('prev')) {
      // Position prev slide correctly based on direction
      slide.style.transform = isRTL ? 'translateX(100%)' : 'translateX(-100%)';
    } else {
      // Position inactive slides correctly based on direction
      slide.style.transform = isRTL ? 'translateX(-100%)' : 'translateX(100%)';
    }
  });
}

// // Initialize language on page load
// document.addEventListener('DOMContentLoaded', () => {
//   setLanguage(currentLang);
  
//   // Language switcher buttons
//   const langBtn = document.getElementById('langBtn');
//   const langBtnMobile = document.getElementById('langBtnMobile');
  
//   const handleLanguageSwitch = () => {
//     const newLang = currentLang === 'ar' ? 'en' : 'ar';
//     setLanguage(newLang);
//     // Small delay to ensure DOM updates are complete
//     setTimeout(() => {
//       if (typeof window.initializeSliderDirection === 'function') {
//         window.initializeSliderDirection();
//       }
//     }, 100);
//   };
  
//   if (langBtn) {
//     langBtn.addEventListener('click', handleLanguageSwitch);
//   }
//   if (langBtnMobile) {
//     langBtnMobile.addEventListener('click', handleLanguageSwitch);
//   }
  
//   // Navbar reference (needed for mobile menu positioning)
//   const navbar = document.getElementById('navbar');
  
//   // Mobile menu toggle
//   const mobileMenuBtn = document.getElementById('mobileMenuBtn');
//   const mobileMenu = document.getElementById('mobileMenu');
//   const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
  
//   // Set mobile menu top position based on navbar height
//   const updateMobileMenuPosition = () => {
//     if (navbar && mobileMenu) {
//       const navbarHeight = navbar.offsetHeight;
//       mobileMenu.style.top = `${navbarHeight}px`;
//     }
//   };
  
//   // Update position on load and resize
//   if (navbar && mobileMenu) {
//     updateMobileMenuPosition();
//     // Ensure menu is not clickable when closed
//     mobileMenu.style.pointerEvents = 'none';
//     window.addEventListener('resize', updateMobileMenuPosition);
//   }
  
//   if (mobileMenuBtn && mobileMenu) {
//     let isMenuOpen = false;
    
//     const toggleMobileMenu = () => {
//       isMenuOpen = !isMenuOpen;
//       mobileMenuBtn.classList.toggle('active');
//       mobileMenu.classList.toggle('translate-y-0');
//       mobileMenu.classList.toggle('-translate-y-full');
//       mobileMenu.classList.toggle('opacity-100');
//       mobileMenu.classList.toggle('opacity-0');
//       // Toggle pointer events
//       if (isMenuOpen) {
//         mobileMenu.style.pointerEvents = 'auto';
//       } else {
//         mobileMenu.style.pointerEvents = 'none';
//       }
//       document.body.style.overflow = isMenuOpen ? 'hidden' : '';
//     };
    
//     mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    
//     // Close menu when clicking on a link
//     mobileNavLinks.forEach(link => {
//       link.addEventListener('click', () => {
//         if (isMenuOpen) {
//           toggleMobileMenu();
//         }
//       });
//     });
    
//     // Close menu when clicking outside
//     document.addEventListener('click', (e) => {
//       if (isMenuOpen && 
//           !mobileMenu.contains(e.target) && 
//           !mobileMenuBtn.contains(e.target)) {
//         toggleMobileMenu();
//       }
//     });
    
//     // Close menu on window resize to desktop
//     window.addEventListener('resize', () => {
//       if (window.innerWidth >= 1024 && isMenuOpen) {
//         toggleMobileMenu();
//       }
//     });
//   }
  
//   // Navbar scroll effect
//   let lastScroll = 0;
  
//   if (navbar) {
//     window.addEventListener('scroll', () => {
//       const currentScroll = window.pageYOffset;
      
//       if (currentScroll > 100) {
//         navbar.classList.add('scrolled');
//       } else {
//         navbar.classList.remove('scrolled');
//       }
      
//       lastScroll = currentScroll;
//     });
//   }
  
//   // Active navigation link highlighting (Scroll Spy)
//   const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');
//   const sections = document.querySelectorAll('section[id]');
  
//   // Make updateActiveLink globally accessible
//   window.updateActiveLink = () => {
//     const scrollY = window.pageYOffset || window.scrollY;
//     const offset = 150; // Offset for better detection
    
//     let currentSection = '';
    
//     sections.forEach(section => {
//       const sectionHeight = section.offsetHeight;
//       const sectionTop = section.offsetTop - offset;
//       const sectionId = section.getAttribute('id');
      
//       if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
//         currentSection = sectionId;
//       }
//     });
    
//     // Handle case when at top of page
//     if (scrollY < 100) {
//       currentSection = '';
//     }
    
//     // Update active states
//     navLinks.forEach(link => {
//       const href = link.getAttribute('href');
//       link.classList.remove('active');
      
//       if (currentSection && href === `#${currentSection}`) {
//         link.classList.add('active');
//       } else if (!currentSection && (href === '#' || href === '#home' || !href)) {
//         link.classList.add('active');
//       }
//     });
//   };
  
//   // Throttle scroll events for better performance
//   let scrollTimeout;
//   const handleScroll = () => {
//     if (scrollTimeout) {
//       window.cancelAnimationFrame(scrollTimeout);
//     }
//     scrollTimeout = window.requestAnimationFrame(window.updateActiveLink);
//   };
  
//   window.addEventListener('scroll', handleScroll, { passive: true });
//   window.addEventListener('scrollend', window.updateActiveLink, { passive: true }); // For browsers that support it
//   window.updateActiveLink();
  
//   // Ensure slider direction is set after a short delay
//   setTimeout(() => {
//     if (typeof window.initializeSliderDirection === 'function') {
//       window.initializeSliderDirection();
//     }
//   }, 100);
// });

// Hero Slider Functionality
(function() {
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.slider-dot');
  const totalSlides = slides.length;
  let autoPlayInterval;

  // Preload images for better performance
  function preloadImages() {
    const images = document.querySelectorAll('.slide-image');
    images.forEach((img, index) => {
      if (img.complete) {
        img.classList.add('loaded');
      } else {
        img.addEventListener('load', function() {
          this.classList.add('loaded');
        });
        img.addEventListener('error', function() {
          // Fallback if image fails to load
          this.style.display = 'none';
        });
      }
    });
  }

  // Initialize image preloading
  preloadImages();

  // Initialize slider direction on load - exposed globally
  window.initializeSliderDirection = function() {
    const isRTL = document.documentElement.dir === 'rtl';
    slides.forEach((slide, i) => {
      if (slide.classList.contains('active')) {
        slide.style.transform = 'translateX(0)';
      } else {
        slide.style.transform = isRTL ? 'translateX(-100%)' : 'translateX(100%)';
      }
    });
  };

  // Initialize on page load
  window.initializeSliderDirection();

  function showSlide(index) {
    const isRTL = document.documentElement.dir === 'rtl';
    
    // Remove active class from all slides and dots
    slides.forEach(slide => {
      slide.classList.remove('active', 'prev');
    });
    dots.forEach(dot => dot.classList.remove('active'));

    // Add active class to current slide and dot
    slides[index].classList.add('active');
    dots[index].classList.add('active');

    // Add prev class to previous slide for animation
    const prevIndex = index === 0 ? totalSlides - 1 : index - 1;
    slides[prevIndex].classList.add('prev');

    // Update transforms based on direction
    slides.forEach((slide, i) => {
      if (i === index) {
        slide.style.transform = 'translateX(0)';
      } else if (i === prevIndex) {
        slide.style.transform = isRTL ? 'translateX(100%)' : 'translateX(-100%)';
      } else {
        slide.style.transform = isRTL ? 'translateX(-100%)' : 'translateX(100%)';
      }
    });

    // Trigger image zoom animation
    const activeSlideImage = slides[index].querySelector('.slide-image');
    if (activeSlideImage) {
      activeSlideImage.style.animation = 'none';
      setTimeout(() => {
        activeSlideImage.style.animation = 'zoomIn 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards';
      }, 3000);
    }

    currentSlide = index;
  }

  function nextSlide() {
    const next = (currentSlide + 1) % totalSlides;
    showSlide(next);
  }

  function prevSlide() {
    const prev = currentSlide === 0 ? totalSlides - 1 : currentSlide - 1;
    showSlide(prev);
  }

  // Navigation buttons
  document.getElementById('nextBtn').addEventListener('click', () => {
    const isRTL = document.documentElement.dir === 'rtl';
    if (isRTL) {
      nextSlide();
    } else {
      prevSlide();
    }
    resetAutoPlay();
  });

  document.getElementById('prevBtn').addEventListener('click', () => {
    const isRTL = document.documentElement.dir === 'rtl';
    if (isRTL) {
      prevSlide();
    } else {
      nextSlide();
    }
    resetAutoPlay();
  });

  // Dot navigation
  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      showSlide(index);
      resetAutoPlay();
    });
  });

  // Auto-play functionality
  function startAutoPlay() {
    autoPlayInterval = setInterval(nextSlide, 5000);
  }

  function resetAutoPlay() {
    clearInterval(autoPlayInterval);
    startAutoPlay();
  }

  // Pause on hover and parallax effect
  const slider = document.querySelector('.hero-slider');
  if (slider) {
    slider.addEventListener('mouseenter', () => {
      clearInterval(autoPlayInterval);
    });

    slider.addEventListener('mouseleave', () => {
      startAutoPlay();
      // Reset parallax effect
      const activeSlide = slider.querySelector('.slide.active');
      if (activeSlide) {
        const image = activeSlide.querySelector('.slide-image');
        if (image) {
          image.style.transform = 'scale(1)';
        }
      }
    });

    // Parallax effect on mouse move (optional enhancement)
    slider.addEventListener('mousemove', (e) => {
      const activeSlide = slider.querySelector('.slide.active');
      if (activeSlide) {
        const image = activeSlide.querySelector('.slide-image');
        if (image && window.innerWidth > 768) {
          const rect = slider.getBoundingClientRect();
          const x = ((e.clientX - rect.left) / rect.width - 0.5) * 20;
          const y = ((e.clientY - rect.top) / rect.height - 0.5) * 20;
          image.style.transform = `scale(1.05) translate(${x}px, ${y}px)`;
        }
      }
    });

    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    slider.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    });

    slider.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
    });

    function handleSwipe() {
      const swipeThreshold = 50;
      const diff = touchStartX - touchEndX;
      const isRTL = document.documentElement.dir === 'rtl';

      if (Math.abs(diff) > swipeThreshold) {
        if ((isRTL && diff > 0) || (!isRTL && diff < 0)) {
          nextSlide();
        } else {
          prevSlide();
        }
        resetAutoPlay();
      }
    }
  }

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
      e.preventDefault();
      const isRTL = document.documentElement.dir === 'rtl';
      if ((isRTL && e.key === 'ArrowRight') || (!isRTL && e.key === 'ArrowLeft')) {
        prevSlide();
      } else {
        nextSlide();
      }
      resetAutoPlay();
    }
  });

  // Initialize auto-play
  startAutoPlay();
})();

// // Contact Form Validation and Handler
// document.addEventListener('DOMContentLoaded', () => {
//   const contactForm = document.getElementById('contactForm');
//   if (!contactForm) return;

//   const formInputs = contactForm.querySelectorAll('.form-input');
  
//   // Validation functions
//   const validators = {
//     name: (value) => {
//       const trimmed = value.trim();
//       if (!trimmed) return translations[currentLang].contactNameError;
//       if (trimmed.length < 2) return translations[currentLang].contactNameError;
//       if (trimmed.length > 100) return translations[currentLang].contactNameError;
//       if (!/^[\u0600-\u06FF\sA-Za-z]+$/.test(trimmed)) return translations[currentLang].contactNameError;
//       return '';
//     },
//     email: (value) => {
//       const trimmed = value.trim();
//       if (!trimmed) return translations[currentLang].contactEmailError;
//       const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//       if (!emailRegex.test(trimmed)) return translations[currentLang].contactEmailError;
//       if (trimmed.length > 255) return translations[currentLang].contactEmailError;
//       return '';
//     },
//     phone: (value) => {
//       const trimmed = value.trim();
//       if (!trimmed) return translations[currentLang].contactPhoneError;
//       const phoneRegex = /^[+]?[0-9\s\-\(\)]{8,20}$/;
//       const digitsOnly = trimmed.replace(/\D/g, '');
//       if (digitsOnly.length < 8 || digitsOnly.length > 20) return translations[currentLang].contactPhoneError;
//       if (!phoneRegex.test(trimmed)) return translations[currentLang].contactPhoneError;
//       return '';
//     },
//     subject: (value) => {
//       const trimmed = value.trim();
//       if (!trimmed) return translations[currentLang].contactSubjectError;
//       if (trimmed.length < 3) return translations[currentLang].contactSubjectError;
//       if (trimmed.length > 200) return translations[currentLang].contactSubjectError;
//       return '';
//     },
//     message: (value) => {
//       const trimmed = value.trim();
//       if (!trimmed) return translations[currentLang].contactMessageError;
//       if (trimmed.length < 10) return translations[currentLang].contactMessageError;
//       if (trimmed.length > 1000) return translations[currentLang].contactMessageError;
//       return '';
//     }
//   };

//   // Show error function
//   const showError = (input, message) => {
//     input.classList.add('error');
//     input.classList.remove('valid');
//     const errorSpan = input.parentElement.querySelector('.error-message');
//     if (errorSpan) {
//       errorSpan.textContent = message;
//       errorSpan.classList.remove('hidden');
//     }
//   };

//   // Show success function
//   const showSuccess = (input) => {
//     input.classList.remove('error');
//     input.classList.add('valid');
//     const errorSpan = input.parentElement.querySelector('.error-message');
//     if (errorSpan) {
//       errorSpan.classList.add('hidden');
//     }
//   };

//   // Validate single field
//   const validateField = (input) => {
//     const fieldName = input.name || input.id;
//     const value = input.value;
//     const validator = validators[fieldName];
    
//     if (validator) {
//       const error = validator(value);
//       if (error) {
//         showError(input, error);
//         return false;
//       } else {
//         showSuccess(input);
//         return true;
//       }
//     }
//     return true;
//   };

//   // Validate all fields
//   const validateForm = () => {
//     let isValid = true;
//     formInputs.forEach(input => {
//       if (!validateField(input)) {
//         isValid = false;
//       }
//     });
//     return isValid;
//   };

//   // Real-time validation on blur
//   formInputs.forEach(input => {
//     input.addEventListener('blur', () => {
//       validateField(input);
//     });

//     input.addEventListener('input', () => {
//       // Clear error on input if field becomes valid
//       if (input.classList.contains('error')) {
//         const error = validators[input.name || input.id](input.value);
//         if (!error) {
//           showSuccess(input);
//         }
//       }
//     });
//   });

//   // Form submission
//   contactForm.addEventListener('submit', function(e) {
//     e.preventDefault();
    
//     // Clear all previous errors
//     formInputs.forEach(input => {
//       input.classList.remove('error', 'valid');
//       const errorSpan = input.parentElement.querySelector('.error-message');
//       if (errorSpan) {
//         errorSpan.classList.add('hidden');
//       }
//     });

//     // Validate form
//     if (!validateForm()) {
//       const formMessage = document.getElementById('formMessage');
//       if (formMessage) {
//         formMessage.classList.remove('hidden');
//         formMessage.className = 'mt-4 p-4 rounded-xl text-center font-semibold bg-red-500/20 text-red-400 border border-red-500/30';
//         formMessage.textContent = translations[currentLang].contactError;
        
//         // Scroll to first error
//         const firstError = contactForm.querySelector('.error');
//         if (firstError) {
//           firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
//           firstError.focus();
//         }
//       }
//       return;
//     }

//     const form = this;
//     const formMessage = document.getElementById('formMessage');
//     const submitButton = form.querySelector('button[type="submit"]');
//     const originalButtonText = submitButton.textContent;
    
//     // Get form data
//     const formData = {
//       name: document.getElementById('name').value.trim(),
//       email: document.getElementById('email').value.trim(),
//       phone: document.getElementById('phone').value.trim(),
//       subject: document.getElementById('subject').value.trim(),
//       message: document.getElementById('message').value.trim()
//     };
    
//     // Show loading state
//     submitButton.disabled = true;
//     submitButton.textContent = translations[currentLang].contactSending;
//     if (formMessage) {
//       formMessage.classList.add('hidden');
//     }
    
//     // Simulate form submission
//     setTimeout(() => {
//       // Show success message
//       if (formMessage) {
//         formMessage.classList.remove('hidden');
//         formMessage.className = 'mt-4 p-4 rounded-xl text-center font-semibold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30';
//         formMessage.textContent = translations[currentLang].contactSuccess;
//       }
      
//       // Reset form and remove validation classes
//       form.reset();
//       formInputs.forEach(input => {
//         input.classList.remove('error', 'valid');
//         const errorSpan = input.parentElement.querySelector('.error-message');
//         if (errorSpan) {
//           errorSpan.classList.add('hidden');
//         }
//       });
      
//       // Reset button
//       submitButton.disabled = false;
//       submitButton.textContent = originalButtonText;
      
//       // Hide message after 5 seconds
//       if (formMessage) {
//         setTimeout(() => {
//           formMessage.classList.add('hidden');
//         }, 5000);
//       }
//     }, 1500);
//   });

//   // About Section Tab System
//   const aboutTabs = document.querySelectorAll('.about-tab');
//   const tabContents = document.querySelectorAll('.tab-content');
  
//   if (aboutTabs.length > 0 && tabContents.length > 0) {
//     aboutTabs.forEach(tab => {
//       tab.addEventListener('click', () => {
//         const targetTab = tab.getAttribute('data-tab');
        
//         // Remove active class from all tabs
//         aboutTabs.forEach(t => {
//           t.classList.remove('active');
//         });
        
//         // Add active class to clicked tab
//         tab.classList.add('active');
        
//         // Hide all tab contents
//         tabContents.forEach(content => {
//           content.classList.remove('active');
//         });
        
//         // Show target tab content
//         const targetContent = document.querySelector(`.tab-content[data-content="${targetTab}"]`);
//         if (targetContent) {
//           targetContent.classList.add('active');
//         }
//       });
//     });
//   }
// });

// Smooth scroll for anchor links with active state update
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href === '#' || href === '#!') {
      e.preventDefault();
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
      // Update active state after scroll
      setTimeout(() => {
        if (typeof window.updateActiveLink === 'function') {
          window.updateActiveLink();
        }
      }, 500);
      return;
    }
    
    e.preventDefault();
    const target = document.querySelector(href);
    if (target) {
      const navbarHeight = 80;
      const offsetTop = target.offsetTop - navbarHeight;
      
      // Update active state immediately for better UX
      document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
        link.classList.remove('active');
      });
      this.classList.add('active');
      
      window.scrollTo({
        top: offsetTop,
        behavior: 'smooth'
      });
      
      // Update active state after scroll completes
      const updateAfterScroll = () => {
        const scrollY = window.pageYOffset || window.scrollY;
        const targetTop = target.offsetTop - navbarHeight;
        const targetBottom = target.offsetTop + target.offsetHeight - navbarHeight;
        
        if (scrollY >= targetTop - 10 && scrollY <= targetBottom + 10) {
          if (typeof window.updateActiveLink === 'function') {
            window.updateActiveLink();
          }
        } else {
          // Continue checking until we reach the target
          requestAnimationFrame(updateAfterScroll);
        }
      };
      
      // Start checking after a short delay
      setTimeout(() => {
        updateAfterScroll();
      }, 100);
      
      // Final update after scroll should be complete
      setTimeout(() => {
        if (typeof window.updateActiveLink === 'function') {
          window.updateActiveLink();
        }
      }, 800);
    }
  });
});

// Service details toggle buttons
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.service-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const card = btn.closest('.service-card');
      if (!card) return;
      const details = card.querySelector('.service-details');
      const expanded = btn.getAttribute('aria-expanded') === 'true';

      if (details) {
        details.classList.toggle('hidden');
      }

      btn.setAttribute('aria-expanded', String(!expanded));

      // Update button label (simple toggle) — language will be reapplied by setLanguage when switching
      const labelSpan = btn.querySelector('[data-i18n]');
      if (labelSpan) {
        if (!expanded) {
          // now expanded -> show "Hide" text
          labelSpan.textContent = currentLang === 'ar' ? 'إخفاء' : 'Hide';
        } else {
          // collapsed -> show learn more
          labelSpan.textContent = translations[currentLang].serviceLearnMore || (currentLang === 'ar' ? 'اعرف المزيد' : 'Learn More');
        }
      }
    });
  });
});
