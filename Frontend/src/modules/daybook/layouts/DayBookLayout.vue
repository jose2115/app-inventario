<template>
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />


<div class="w-full h-auto">
  <router-view/>
</div>

<div class="w-full h-12 fixed bottom-8 flex justify-center  ">
        <div class="w-11/12 h-12 bg-blue-500 text-white rounded-lg flex justify-between px-4 pt-2">
            <div>
              <router-link to="/">
                <span class="text-2xl"><i class="bx bx bxs-home"></i></span>
              </router-link>
                
            </div>
            <div>
              <router-link to="/productos">
                <span class="text-2xl"><i class="bx bxs-box"></i></span>
              </router-link>
                
            </div>
            <div>
              <router-link to="/inventarios">
                <span class="text-2xl"><i class="bx bx-file"></i></span>
              </router-link>
                
            </div>
            <div>
              <router-link to="/perfil">
                <span class="text-2xl"><i class="bx bxs-user-circle"></i></span>
              </router-link>
                
            </div>
        </div>
    </div>

</template>



<script>
import { defineAsyncComponent } from 'vue'
import { mapActions, mapState, mapGetters } from 'vuex'



export default {
    components: {
        Header: defineAsyncComponent(() => import('../components/Header.vue')),
    },
    methods: {
      
    },
    computed: {
        
    },
    data() {

         return {
            visible:false,
            notificacion:false,
            showMenu: true,
            showMenuPerfil: false,
            menu:'',
            items: [
                {
                    label: 'Options',
                    items: [
                        {
                            label: 'Perfil',
                            icon: 'pi pi-user',
                        },
                        {
                            label: 'Radicados',
                            icon: 'pi pi-file',
                        },
                        {
                            label: 'Usuarios',
                            icon: 'pi pi-users',
                        },
                        {
                            label: 'Configuracion',
                            icon: 'pi pi-cog',
                        }
                    ]
                },
    
            ],
         }
        
    },
    created() {
        
    }
}

</script>

<style>



</style>