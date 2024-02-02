// permissionDirective.js

export default {

    mounted(el, binding) {

            const userPermissions =  localStorage.getItem('permisos');
            const requiredPermission = binding.value;
    
            if (!userPermissions.includes(requiredPermission)) {
                el.style.display = 'none';
            }
    },
  };
