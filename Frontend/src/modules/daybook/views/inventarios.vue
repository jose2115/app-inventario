<template>

<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<div class="w-full pt-4 ">

    <div class="w-full h-auto flex justify-center items-center mb-2">
        <p class="text-xl font-semibold">Inventarios</p>
    </div>

    <div class="w-full h-12 px-2 mb-2 flex justify-center items-center mt-2 ">
        <Button  @click="visible = true , type='Crear'" class="w-3/4" label="Nuevo"  outlined />
    </div>

    <div class="w-full  px-3 pt-4 h-80 overflow-y-auto py-2 ">

        <div    v-for="(item, index) in inventarios" :key="index" class="w-full h-auto flex  mb-3" :class="{ 'bg-blue-100': item.select === 1 }" >
            <div @click="seleccionar(item.id)" class="w-full h-full pl-2 py-2 ">
                <p class="font-semibold">Nombre: {{item.name}} </p>
                <p class="font-semibold">Fecha: <span class="font-normal">{{item.date}} </span></p>
           
            </div>
            <div class="w-2 h-auto py-2   flex justify-center items-center">
                <div class=" flex justify-left items-center relative " >
                    <span @click="eliminar(item.id)" class="pi pi-trash text-xl text-gray-700"></span>    
                </div>
            </div>
            
        </div>
    </div>


    <div class="w-full h-12 px-2 mb-2 flex justify-center items-center mt-2 ">
        <Button class="w-3/4" label="Exportar" severity="secondary" outlined />
    </div>
    
</div>

<Dialog v-model:visible="visible" modal header="Inventario" class="w-full mx-2" >
    <ModalInventario :data="selectItem" :typeSubmit="type" ></ModalInventario>
    <template #footer>
        <Button label="Cerrar" icon="pi pi-times" @click="visible = false" text />
    </template>
</Dialog>

<Toast position="bottom-right" class="absolute right-0" />
    <ConfirmDialog></ConfirmDialog>
</template>

<script>

import { defineAsyncComponent } from 'vue'
import { mapActions, mapState, mapGetters } from 'vuex'
import { PhotoService } from '../service/PhotoService';

import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";



export default {

    setup(){

        const confirm = useConfirm();
        const toast = useToast();

        return { confirm, toast }
    },

    components: {
        ModalInventario: defineAsyncComponent(() => import('../modal/Modal-Inventario.vue')),
    },
    methods: {
      
      ...mapActions('inventario', ['loadInventarios', 'selectInventario', 'deleteInventario']),
      
      loadData() {
            this.loadInventarios();
        },

        eliminar(id){
                this.$confirm.require({
                    message: 'Esta seguro de eliminar el item?',
                    header: 'Confirmation',
                    icon: 'pi pi-info-circle',
                    acceptClass: 'bg-blue-500',
                    accept: () => {

                        const data = {
                            id              : id,
                            type            : this.typeFiling
                        };
                        this.deleteInventario(id)
        
                        this.$toast.add({ severity: 'info', summary: 'Eliminado', detail: 'Item Eliminado', life: 3000 });
                    },
                    
                });
            },

        seleccionar(id){
                this.$confirm.require({
                    message: 'Esta seguro de seleccionar el inventario?',
                    header: 'Confirmation',
                    icon: 'pi pi-info-circle',
                    acceptClass: 'bg-blue-500',
                    accept: () => {

                        const data = {
                            id              : id,
                            type            : this.typeFiling
                        };
                        this.selectInventario(id)
                        this.loadInventarios();
                        //this.$toast.add({ severity: 'info', summary: 'Eliminado', detail: 'Item Eliminado', life: 3000 });
                    },
                    
                });
            },

    },
    computed: {
        ...mapGetters('inventario', ['getInventarios']),

        inventarios(){
            return this.getInventarios();
        }
    },
    data() {

         return {
            select:true,
            visible:false,
            type: 'Crear',
            images: null,
            
            
         }
        
    },
    created() {
        this.loadData();
    },
}

</script>