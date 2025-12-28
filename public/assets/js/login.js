// Helper to handle focus states
      function setupInputInteraction(inputId, labelId, iconId) {
        const input = document.getElementById(inputId);
        const label = document.getElementById(labelId);
        const icon = document.getElementById(iconId);

        const activeClasses = {
          label: ['text-indigo-400'],
          icon: ['text-indigo-500'],
          input: ['border-indigo-500/50', 'ring-2', 'ring-indigo-500/20', 'shadow-[0_0_15px_rgba(99,102,241,0.1)]']
        };

        const inactiveClasses = {
          label: ['text-gray-400'],
          icon: ['text-gray-500', 'group-hover:text-gray-400'],
          input: ['border-white/10', 'hover:border-white/20', 'hover:bg-white/10']
        };

        input.addEventListener('focus', () => {
          // Label
          label.classList.remove(...inactiveClasses.label);
          label.classList.add(...activeClasses.label);
          
          // Icon
          icon.classList.remove('text-gray-500', 'group-hover:text-gray-400');
          icon.classList.add(...activeClasses.icon);
          
          // Input
          input.classList.remove(...inactiveClasses.input);
          input.classList.add(...activeClasses.input);
        });

        input.addEventListener('blur', () => {
          // Label
          label.classList.remove(...activeClasses.label);
          label.classList.add(...inactiveClasses.label);
          
          // Icon
          icon.classList.remove(...activeClasses.icon);
          icon.classList.add('text-gray-500', 'group-hover:text-gray-400');
          
          // Input
          input.classList.remove(...activeClasses.input);
          input.classList.add(...inactiveClasses.input);
        });
      }

      // Setup interactions
      setupInputInteraction('email', 'label-email', 'icon-email');
      setupInputInteraction('password', 'label-password', 'icon-password');

      // Form Submission
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const btnLoader = document.getElementById('btnLoader');