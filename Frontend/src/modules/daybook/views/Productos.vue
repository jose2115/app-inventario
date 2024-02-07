<template>

<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<div class="w-full pt-4 ">

    <div class="w-full h-auto flex justify-center items-center mb-2">
        <p class="text-xl font-semibold">Produtos</p>
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
      

        <div v-for="(item, index) in productos" :key="index" class="w-full h-auto bg-gray-300 flex  mb-3   ">
            <div class="w-full h-full pl-2 py-2 ">
                <p class="font-semibold"> {{item.description}} </p>
                <p class="font-semibold">Talla: <span class="font-normal"> {{item.talla}} </span> </p>

                <p v-for="(i, index) in item.stocks" :key="index" class="font-semibold"> {{i.name}} : <span class="font-normal"> {{i.stock}} </span> </p>
                
                <p class="font-semibold">Color: <span class="font-normal"> {{item.color}} </span></p>
                <p class="font-semibold">ref: {{item.ref}} </p>
            </div>
            <!-- <div class="w-2 h-auto py-2   flex justify-center items-center">
                <div class=" flex justify-left items-center relative " >
                    <SpeedDial cla  :model="items" direction="left" class="absolute -right-14 bg-gray-300" severity="success" buttonClass="p-button-info" :style="{ transform: 'scale(0.7)' }"   />
                </div>
            </div> -->
            
        </div>
    </div>
    
</div>


</template>

<script>

import { defineAsyncComponent, ref, onMounted } from 'vue'
import { mapActions, mapState, mapGetters } from 'vuex'



export default {


    components: {
     
    },
    methods: {
      
      loadData() {
            this.loadProducts();
        },

      ...mapActions('products', ['loadProducts', 'searchProduct']),

        buscar(){

            console.log("buscando prodcuto ", this.search)
            this.searchProduct(this.search)
        }

    },
    computed: {
        
        ...mapGetters('products', ['getProductos']),

        productos(){
            return this.getProductos(this.search)
        }
    },
    data() {

         return {
            search: '',
            visible:false,
            images: null,
         
            items: [
                  {
                      label: 'Add',
                      icon: 'pi pi-eye',
                      command: (valor) => {
                        
                        }
                  },
                 
                  {
                      label: 'Delete',
                      icon: 'pi pi-trash',
                      command: () => {

                            this.visibleEditEntry = true
                            this.valueCommenType = { name: 'Radicado', value: 1 }
                        }
                  },
                  
                 
              ]
            
         }
        
    },
    created() {
        this.loadData();
    },

}

</script>