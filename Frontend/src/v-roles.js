// rolesDirective.js

export default {

    mounted(el, binding) {

            const userRoles =  localStorage.getItem('roles');
            const requiredRoles = binding.value;
    
            if (!userRoles.includes(requiredRoles)) {
                el.style.display = 'none';
            }
    },
  };
