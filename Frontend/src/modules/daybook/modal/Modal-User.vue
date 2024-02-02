<template>
    <div class="card justify-content-center">
        <form   @submit.prevent="handleSubmit">

            <div class="grid grid-cols-1 lg:grid-cols-2  gap-4 mt-4">


            <div class="flex flex-column gap-2">
                    <label for="username" class="text-gray-800">Nombre</label>
                    <InputText class="w-full"  v-model="dataForm.name" @blur="v$.dataForm.name.$touch" :class="{'p-invalid': v$.dataForm.name.$errors.length > 0}"/>
                    <small class="text-red-500" v-for="error of v$.dataForm.name.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
            </div>

            <div class="flex flex-column gap-2">
                    <label for="username" class="text-gray-800">Correo electronico</label>
                    <InputText class="w-full"  v-model="dataForm.email" @blur="v$.dataForm.email.$touch" :class="{'p-invalid': v$.dataForm.email.$errors.length > 0}"/>
                    <small class="text-red-500" id="username-help">{{ messageError.email }}</small>
                    <small class="text-red-500" v-for="error of v$.dataForm.email.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
            </div>

            <div class="flex flex-column gap-2">
                <label for="username" class="text-gray-800">Contraseña</label>
                <Password class="w-full" v-model="dataForm.password" @blur="v$.dataForm.password.$touch" :class="{'p-invalid': v$.dataForm.password.$errors.length > 0}"
                promptLabel="Elige contraseña" weakLabel="Simple" mediumLabel="Media" strongLabel="Compleja" />
            </div>

        

            <div v-permission="'asing_role'" class="flex flex-column gap-2">
                <label v-permission="'asing_role'" for="username" class="text-gray-800 ">Roles</label>
                <MultiSelect v-permission="'asing_role'" v-model="dataForm.selectedRoles" display="chip" :options="roles" @blur="v$.dataForm.selectedRoles.$touch" :class="{'p-invalid': v$.dataForm.selectedRoles.$errors.length > 0}"
                optionLabel="name" placeholder="Seleccion de roles"
                    :maxSelectedLabels="3" class="w-full " />
                <small class="text-red-500" v-for="error of v$.dataForm.selectedRoles.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
            </div>

            
            </div>
           


            <div v-if="typeSubmit== 'Crear'" class="w-full flex justify-content-end mt-4">
                <Button type="submit" label="Guardar" class="bg-blue-500" icon="pi pi-plus"/>
            </div>
            <div v-if="typeSubmit== 'Edit'" class="w-full flex justify-content-end mt-4">
                <Button type="submit" label="Editar" class="bg-blue-500" icon="pi pi-plus"/>
            </div>
            
        </form>
    </div>
</template>

<script>
import { mapActions, mapState, mapGetters } from 'vuex'
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, maxLength, minValue, maxValue, email} from '@vuelidate/validators'
export default {
    setup() {
      return { v$: useVuelidate() }
    },
    props:{
        typeSubmit:String,
        data:Object
    },
    methods: {
            loadData() {

                console.log("props ", this.typeSubmit)
                this.loadRoles();
            },
        
            ...mapActions('users', ['createUser', 'editUser']),
            ...mapActions('roles', ['loadRoles']),


            async handleSubmit() {

                const result = await this.v$.$validate()

                    if (!result) {
                        // notify user form is invalid
                        return
                    }

                
                if(this.typeSubmit == "Crear"){


                    const data = {
                        id  : this.data.id, 
                        name: this.dataForm.name,
                        password: this.dataForm.password,
                        selectedRoles  : this.dataForm.selectedRoles,
                        email : this.dataForm.email,
                    };

                   this.createUser(data);
                }else{
                    
                    
                    const data = {
                        id  : this.data.id, 
                        name: this.dataForm.name,
                        password: this.dataForm.password,
                        selectedRoles  : this.dataForm.selectedRoles,
                        email : this.dataForm.email,

                    };

                    this.editUser(data);

                }
                

                
            },

            loadForm(){

                this.dataForm.name              = this.data.name
                this.dataForm.email             = this.data.email

                const rolesArray = this.data.roles;

                const roles = rolesArray.replace(/[()]/g, "").split(", ").map(name => ({ name }));

                console.log("roles ", roles )
                this.dataForm.selectedRoles     = roles
            },

    },
    computed: {

        ...mapGetters('roles', ['getRoles']),
        ...mapGetters('users', ['getMessageError']),
 

          roles(){


            console.log("roles back ",this.getRoles())
            return this.getRoles()
          },

        messageError() {
            return this.getMessageError
        },

    
    },

    data(){

        return{
            value: null,
            dataForm:{
                name:'',
                email:'',
                password:'',
                selectedRoles:'',
            },

        }
    },
    validations(){

        if(this.typeSubmit == "Crear"){

            return{

                dataForm:{
                
                name                  : { required, minLength: minLength(5), maxLength: maxLength(25) },
                email                 : { required, email },
                selectedRoles         : { required },
                password              : { required, minLength: minLength(8), maxLength: maxLength(20) },
                }

            }

        }else{

            return{

                dataForm:{
                name                  : { required, minLength: minLength(5), maxLength: maxLength(25) },
                email                 : { required, email },
                selectedRoles         : { required },
                password              : {  minLength: minLength(8), maxLength: maxLength(20) },
                }

            }
            
        }

        
      
    },
    created(){
        this.loadData()

        if(this.typeSubmit != "Crear"){
            this. loadForm()
        }
        
    }
}
</script>

<style>

</style>