<template>

<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<div class="w-full ">

    <div class="grid grid-cols-2 gap-3 px-4 pt-16">
        <router-link v-permission="'see_users'" to="/productos">
            <div class="w-full h-32 bg-blue-500 text-white rounded-lg flex justify-center content-center items-center hover:shadow-lg  ">
                <span class="text-6xl"><i class="bx bxs-box"></i></span>
            </div>
        </router-link>
        
        <router-link v-permission="'update_inventario'" to="/contar">
            <div class="w-full h-32 bg-blue-500 text-white rounded-lg flex justify-center content-center items-center hover:shadow-lg   ">
                <span class="text-6xl"><i class="bx bx-barcode-reader"></i></span>
            </div>
        </router-link>
        
        <router-link v-permission="'load_file'" to="/importados">
            <div class="w-full h-32 bg-blue-500 text-white rounded-lg flex justify-center content-center items-center hover:shadow-lg   ">
                <span class="text-6xl"><i class="bx bxs-file-export"></i></span>
            </div>
        </router-link>

        <router-link v-permission="'see_history'" to="/historial">
            <div class="w-full h-32 bg-blue-500 text-white rounded-lg flex justify-center content-center items-center hover:shadow-lg   ">
                <span class="text-6xl"><i class="bx bxs-bar-chart-alt-2"></i></span>
            </div>
        </router-link>

        <router-link v-permission="'see_users'" to="/usuarios">
            <div class="w-full h-32 bg-blue-500 text-white rounded-lg flex justify-center content-center items-center hover:shadow-lg   ">
                <span class="text-6xl"><i class="bx bxs-user-rectangle"></i></span>
            </div>
        </router-link>

        <router-link v-permission="'see_configuration'"  to="/config">
            <div class="w-full h-32 bg-blue-500 text-white rounded-lg flex justify-center content-center items-center hover:shadow-lg   ">
                <span class="text-6xl"><i class="bx bxs-cog"></i></span>
            </div>
        </router-link>
        
        
    </div>
    
</div>


</template>

<script>

import { mapActions,  } from 'vuex'


export default {


    components: {
        
    },
    methods: {
      
      loadData() {
            //this.loadProducts();
        },

      ...mapActions('products', ['loadProducts']),

    },
    computed: {
        
    },
    data() {

         return {
            visible:false,
            images: null,
         }
        
    },
    created() {
        this.loadData();
    },

  
}

</script>