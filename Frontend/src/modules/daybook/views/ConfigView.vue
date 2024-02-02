<template>
  <div class="bg-white w-full h-auto shadow-md p-4" >
    <div class="w-full flex items-center justify-left border-b border-b-gray-300 pb-4">
        <i class='bx bxs-cog text-xl mr-2 '></i>
        <span  class="font-semibold text-gray-800">Configuracion</span>
    </div>

    <div class="card">
        <TabView :scrollable="true">

            <TabPanel  >
                <template  #header>
                    <i  @click="handleClick('zona')" class='bx bxs-book text-lg mr-2'></i>
                    <span @click="handleClick('zona')" class="font-semibold text-sm">Categorias</span>
                </template>
            </TabPanel>
    
            <TabPanel  >
                <template  #header>
                    <i v-permission="'see_permission'" @click="handleClick('roles')" class='bx bxs-shield text-lg mr-2'></i>
                    <span v-permission="'see_permission'" @click="handleClick('roles')" class="font-semibold text-sm">Roles&nbsp;Usuario</span>
                </template>
            </TabPanel>
        
        </TabView>
    </div>

    <div class="w-full h-full">

     
        <Zona v-permission="'see_categoria'"   v-if="activeName == 'zona'"  />
        <RolesUser v-permission="'see_permission'"  v-if="activeName == 'roles'"  />

    </div>

  </div>
</template>

<script>




import { defineAsyncComponent } from 'vue'
import { mapActions } from 'vuex'
export default {
   
    name: 'ConfigView',
    components: {

        RolesUser: defineAsyncComponent(() => import('../components/Roles/RolesUser.vue')),
        Zona: defineAsyncComponent(() => import('../components/zona/ZonaView.vue')),

    },

    data(){

        return {
            activeName: '',

     
        }
        
    },
    methods:{
        handleClick(valor){

            this.activeName = valor

            console.log("seleccionado ", valor )
        },

        ...mapActions('company', ['loadCompany']),
    },
    created(){
        this.loadCompany();
        
    }

}
</script>

<style>

.ancho{
    width: 100%;
}
</style>