<template>
   <div class="bg-white w-full h-auto  p-4" >

        <div class="w-full flex items-center justify-left border-b border-b-gray-300 pb-4 relative">
            <i class='bx bxs-user-detail text-xl mr-2 '></i>
            <span  class="font-semibold text-gray-800">Usuarios</span>
        </div>
        <!-- <p v-role="'Administrador'">Este párrafo solo se muestra si tienes permiso para ver.</p> -->
        <div class="w-full h-full mt-4 border border-gray-200">
   
            <div class="card pb-40">
                    <DataTable v-model:filters="filters"  :value="users" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                        <template #header>
                            <Button v-permission="'create_users'" label="Nuevo" class="bg-blue-500 mr-2" icon="pi pi-plus" @click="visible = true, type='Crear'" />
                            <span class="p-input-icon-left">
                                <i class="pi pi-search" />
                                <InputText v-model="filters['global'].value" placeholder="Buscar" />
                            </span>
                        </template>

                        <Column field="name" header="Nombre" >
                        <template #body="{data}">
                            <div class="flex align-items-center gap-2">
                                <span>{{ data.name }}</span>
                            </div>
                        </template>
                        </Column>
                        <Column field="email" header="Correo" ></Column>
                        

                     


                        <Column field="roles" header="Roles" >
                        </Column>
                        
                        <Column field="state" header="Estado" >
                        <template #body="{data}">
                            <Tag v-if="data.state === 1" severity="success" value="Activo"></Tag>
                            <Tag v-if="data.state === 0" severity="warning" value="Inactivo"></Tag>
                        </template>
                        </Column>
                    
                        <Column field="status" header="Acciones" >
                        <template #body="{data}">
                            <Button v-permission="'update_users'" @click="select(data), visible = true"  icon="pi pi-pencil" severity="success" text rounded aria-label="Cancel" />
                            <!-- <Button @click="deleteRoutes(data.id)" icon="pi pi-trash" severity="danger" text rounded aria-label="Cancel" /> -->
                            <Button v-permission="'delete_users'" @click="changeStateUser(data.id)" icon="pi pi-sync" severity="danger" text rounded aria-label="Cancel" />
                        </template>
                        </Column>
                    </DataTable>
            </div>



            <Dialog v-model:visible="visible" modal header="Usuario"  class="w-11/12 lg:w-1/2" >
                <ModalUser :data="selectItem" :typeSubmit="type" ></ModalUser>
                <template #footer>
                    <Button label="Cerrar" icon="pi pi-times" @click="visible = false" text />
                </template>
            </Dialog>

        </div>
   </div>
  
</template>

<script>

import { mapActions, mapState, mapGetters } from 'vuex'
import { defineAsyncComponent } from 'vue'
import { FilterMatchMode, FilterOperator } from 'primevue/api';

export default {

  components: {
      ModalUser: defineAsyncComponent(() => import('../modal/Modal-User.vue'))
    },
  methods:{
    loadData() {
        this.loadUsers();
      },
    select(item)
      {
        this.selectItem = item
        this.type = 'Edit'
      },
    ...mapActions('users', ['loadUsers', 'changeStateUser']),
  },
  computed: {
        ...mapGetters('users', ['getUsers']),

        users(){
          this.visible = false
          return this.getUsers()
        }
    },
  data() {

        return {
            visible: false,
            type: 'Crear',
            id: null,
            selectItem: {
              name: '',
              initials: ''
            },
            filters: {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                Nombre: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
                'Nombre': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
                representative: { value: null, matchMode: FilterMatchMode.IN },
                status: { operator: FilterOperator.OR, constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }] }
            }
        }

    },
  created() {
      this.loadData()
       
    }

}
</script>

<style>

</style>
