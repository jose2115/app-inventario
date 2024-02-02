<template>
    <div class="card flex justify-content-center">
        <SelectButton v-model="value" @change="change" :options="roles" optionLabel="name"  aria-labelledby="custom" />
    </div>
  <div class="w-full h-full pt-4 mt-4 border border-gray-200 pb-40">
      <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-3 mx-2">
        <div class="flex" v-for="(item, index) in permisos" :key="index" >
          
          <InputSwitch v-permission="'asing_permission'" v-model="item.checked" @change="changeStatePermission(item)" /><p class="ml-2"> {{item.name}} </p></div>
      </div>
    
  </div>
  <p v-for="(item, index) in permisosOfRole" :key="index">
    {{item.name}}
  </p>

 
</template>

<script>

import { mapActions, mapState, mapGetters } from 'vuex'

export default {

methods:{
  
    ...mapActions('roles', ['loadRolesConfig', 'loadPermisos', 'loadAllPermisos', 'changeStatePermiso']),

    loadData() {
        this.loadRolesConfig();
        this.loadAllPermisos();
      },
    change(value){

      this.loadPermisos(value.value.id);
    },

    changeStatePermission(value){

  
      const data = {
        rol: this.value.id,
        permiso: value.id,
        accion: value.checked,
      }

      this.changeStatePermiso(data)
    },
   
    
  },
  computed: {
          ...mapGetters('roles', ['getRoles', 'getPermisos', 'getAllPermisos']),
          ...mapState('roles', ['isLoading']),

          roles(){
            return this.getRoles()
          },

          permisos(){
            return this.getAllPermisos()
          },

          permisosOfRole(){
            
            return this.getPermisos()
          },

          
      },
    data() {

        return {
          value:'',
        }

    },
    created() {
        this.loadData()
        
      }

}
</script>

<style>

</style>