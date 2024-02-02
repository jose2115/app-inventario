<template>

<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<div class="w-full pt-4 ">

    <div class="w-full flex px-2 mb-2">
        <span class="p-input-icon-left w-full">
            <i class="pi pi-search" />
            <InputText v-model="search" placeholder="Buscar" class="w-full" />
        </span>
        <div class="flex justify-center items-center px-2 ">
            <Button @click="product" class="w-full pi pi-qrcode" outlined />
        </div>
    </div>

    <div class="card flex justify-content-center px-2">
        <div class="w-full flex justify-content-center">
                <Dropdown v-model="selectedZona" :options="zonas" optionLabel="name" placeholder="Seleccione Zone" checkmark :highlightOnSelect="false" class="w-full md:w-14rem" />
        </div>
        <div class="flex justify-center items-center px-2 ">
            <Button v-permission="'create_categoria'" @click="visible = true , type='Crear'" class="w-full pi pi-plus" outlined />
        </div>
    </div>

    <div class="w-full h-auto flex justify-center items-center my-2">
        <p class="text-xl font-semibold">{{ totalUnidad }} Elementos</p>
    </div>

    <div class="w-full flex ">
        <div class="w-full h-12 px-2 mb-2 flex justify-center items-center mt-2 ">
            <Button class="w-3/4" label="Enviar" @click="cargarItems" outlined />
        </div>
        <!-- <div class="w-full h-12 px-2 mb-2 flex justify-center items-center mt-2 ">
            <Button @click="deleteItems" class="w-3/4" label="Cancelar" severity="danger" outlined />
        </div> -->
    </div>
    

</div>

<div v-if="items.length > 0" class="w-full flex px-2  my-2">
        <span class="p-input-icon-left w-full">
            <i class="pi pi-search" />
            <InputText v-model="searchItem" placeholder="Buscar" class="w-full" />
        </span>
</div>

<div class="w-full  px-2 pt-4 h-screen overflow-y-auto py-2 ">

        <div v-for="(item, index) in items" :key="index" class="w-full h-auto bg-gray-300 flex  mb-3   ">
            <div class="w-full h-full pl-2 py-2 ">
                <p class="font-semibold"> {{item.description}} </p>
                <p class="font-semibold">Cod: <span class="font-normal"> {{item['cod-barra-1']}} </span></p>
                <p class="font-semibold">ref: {{item.ref}} </p>
                <p class="font-semibold">Zona: <span class="font-normal"> {{item.name}} </span></p>
                <div @click="modalUnidad(item, index)" class="w-1/2 h-auto bg-blue-500 rounded-lg p-2">
                    <p class="font-semibold text-white">Unidad: <span class="font-normal"> {{item.unidad}} </span></p>
                </div>
                
            </div>
            <div class="w-2 h-auto py-2   flex justify-center items-center">
                <div class=" flex justify-left items-center relative " >
                    <span @click="eliminar(index)" class="pi pi-trash text-xl text-gray-700"></span>    
                </div>
            </div>
            
        </div>
</div>


<Toast position="bottom-right" class="absolute right-0" />
    <ConfirmDialog></ConfirmDialog>

<Dialog v-model:visible="visible" modal header="Nueva Zona" class="w-full mx-2" >
    <ModalZona :data="selectItem" :typeSubmit="type" ></ModalZona>
    <template #footer>
        <Button label="Cerrar" icon="pi pi-times" @click="visible = false" text />
    </template>
</Dialog>


<Dialog v-model:visible="visibleUnidad" modal header="Unidad" class="w-full mx-2" >
    <ModalUnidad :data="selectUnidad" :position="index" :typeSubmit="type" ></ModalUnidad>
    <template #footer>
        <Button label="Cerrar" icon="pi pi-times" @click="visibleUnidad = false" text />
    </template>
</Dialog>


</template>

<script>

import { defineAsyncComponent } from 'vue'
import { mapActions,  mapGetters } from 'vuex'
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";




export default {

    setup(){

        const confirm = useConfirm();
        const toast = useToast();

        return { confirm, toast }
    },

    components: {
        ModalZona: defineAsyncComponent(() => import('../modal/Modal-Zona.vue')),
        ModalUnidad: defineAsyncComponent(() => import('../modal/Modal-Unidad.vue')),
    },
    methods: {
      

      

      loadData() {
            this.loadProducts();
            this.loadZonasPublic();
        },

        ...mapActions('inventario', ['addItem', 'loadZonasPublic', 'deleteItems', 'deleteItem', 'sendData']),
        ...mapActions('products', ['loadProducts']),

        product(){
            const prod = this.getProduct(this.search);
            const zona = this.selectedZona;
            
            if(!this.search){

                this.$toast.add({ severity: 'info', summary: 'Info', detail: 'campo vació', life: 3000 });
                return
            }

            if(!this.selectedZona){

                this.$toast.add({ severity: 'info', summary: 'Info', detail: 'Seleccione Zona', life: 3000 });
                return
            }


            if(prod){
             const data = [
                    {
                        'prod': prod,
                        'zona': zona
                    }
                ]
                
                this.addItem(data)
                this.search = ''
                this.$toast.add({ severity: 'success', summary: 'Confirmed', detail: 'Agregado', life: 3000 });
            }
        
        },

        cargarItems(){

            if(this.items.length < 1){

                return
            }

            this.sendData(this.items)
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
                        this.deleteItem(id)
        
                        this.$toast.add({ severity: 'info', summary: 'Eliminado', detail: 'Item Eliminado', life: 3000 });
                    },
                    
                });
            },

        modalUnidad(value, index)
        {

            this.visibleUnidad = true;
            this.selectUnidad = value
            this.index = index

        }

    },
    computed: {
        ...mapGetters('inventario', ['getItems','getZonasPublic']),
        ...mapGetters('products', ['getProduct']),

        zonas(){
            return this.getZonasPublic();
        },

        items(){
            return this.getItems(this.searchItem);
        }

        
    },
    data() {

         return {
            selectedZona:'',
            search:'',
            searchItem:'',
            visible: false,
            visibleUnidad:false,
            type: 'Crear',
            images: null,
            selectUnidad: 0,
            index:0,
            selectItem: {
              name: '',
              initials: ''
            },
            totalUnidad: null,
            selectedCity:'',
            cities: [
                { name: 'New York', code: 'NY' },
                { name: 'Rome', code: 'RM' },
                { name: 'London', code: 'LDN' },
                { name: 'Istanbul', code: 'IST' },
                { name: 'Paris', code: 'PRS' }
            ]
            
         }
        
    },
    created() {
    
        this.loadData();
    },

    watch: {
        items: {
        handler(newItems) {
            // Calcular el total de unidad cada vez que cambia el array items
            this.totalUnidad = newItems.reduce((total, item) => total + item.unidad, 0);
        },
        deep: true,
        },
    },
}

</script>
