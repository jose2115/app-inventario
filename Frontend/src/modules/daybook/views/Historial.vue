<template>

<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<div class="w-full pt-4 ">

    <div class="w-full h-auto flex justify-center items-center mb-2">
        <p class="text-xl font-semibold">Produtos Contados</p>
    </div>

    <div class="w-full px-2 mb-2 flex">
        <span class="p-input-icon-left w-full">
            <i class="pi pi-search" />
            <InputText v-model="search" placeholder="Buscar" class="w-full" />
        </span>
        <div class="flex justify-center items-center px-2 ">
            <Button @click="buscar()" class="w-full pi pi-search" outlined />
        </div>
    </div>

    <div class="w-full  px-2 pt-4 h-screen overflow-y-auto py-2 ">

         
        <div v-for="(item, index) in productos" :key="index" class="w-full h-auto bg-gray-200 flex  mb-3   ">
            <div class="w-full h-full pl-2 py-2 ">
                <p class="font-semibold"> {{item.name}} </p>
                <p class="font-semibold">Talla: <span class="font-normal"> {{item.talla}} </span> </p>
                <p class="font-semibold">Unidad: <span class="font-normal"> {{item.total}} </span> </p>
                <p class="font-semibold">Color: <span class="font-normal"> {{item.color}} </span></p>
                <p class="font-semibold">ref: {{item.ref}} </p>
            </div>
            <div class="w-2 h-auto py-2   flex justify-center items-center">
                <!-- <div class=" flex justify-left items-center relative " >
                    <SpeedDial cla  :model="items" direction="left" class="absolute -right-14" severity="success" buttonClass="p-button-info" :style="{ transform: 'scale(0.7)' }"   />
                </div> -->
            </div>
            
        </div>
    </div>
    
</div>


</template>

<script>

import { mapActions, mapState, mapGetters } from 'vuex'


export default {


    components: {
        
    },
    methods: {
      
      loadData() {
            this.loadHistorial();
        },

      ...mapActions('inventario', ['loadHistorial', 'searchHistory']),

        buscar(){

            this.searchHistory(this.search)
        }

    },
    computed: {
        
        ...mapGetters('inventario', ['getHistorial']),

        productos(){
            return this.getHistorial(this.search)
        }


    },
    data() {

         return {
            search: '',
            visible:false,
            images: null,
            
         }
        
    },
    created() {
        this.loadData();
    },

  
}

</script>