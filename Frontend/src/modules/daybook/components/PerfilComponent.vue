<template>

   <div class="w-full h-full lg:col-span-2">
            <div class="card justify-content-center  gap-4">
                <div class="w-full flex items-center justify-left border-b border-b-gray-300 pb-4">
                    <i class='bx bxs-user-pin text-xl mr-2 '></i>
                    <span class="font-semibold text-gray-800">Informacion</span>
                </div>
                <form   >

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">


                    <div class="lg:flex lg:flex-column lg:gap-2">
                            <label for="username" class="text-gray-800">Nombre</label>
                            <InputText class="w-full"  v-model="dataForm.name" @blur="profile$.dataForm.name.$touch" :class="{'p-invalid': profile$.dataForm.name.$errors.length > 0}"/>
                            <small class="text-red-500" v-for="error of profile$.dataForm.name.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
                    </div>


                    <div class="lg:flex lg:flex-column lg:gap-2">
                            <label for="username" class="text-gray-800">Correo electronico</label>
                            <InputText class="w-full"  v-model="dataForm.email" @blur="profile$.dataForm.email.$touch" :class="{'p-invalid': profile$.dataForm.email.$errors.length > 0}"/>
                            <small class="text-red-500" id="username-help">{{ messageError.email }}</small>
                            <small class="text-red-500" v-for="error of profile$.dataForm.email.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
                    </div>


                    <div v-permission="'asing_role'" class="lg:flex lg:flex-column lg:gap-2 lg:col-span-2 ">
                        <label v-permission="'asing_role'" for="username" class="text-gray-800 ">Roles</label>
                        <MultiSelect  v-model="dataForm.selectedRoles" display="chip" :options="roles" @blur="profile$.dataForm.selectedRoles.$touch" :class="{'p-invalid': profile$.dataForm.selectedRoles.$errors.length > 0}"
                        optionLabel="name" placeholder="Seleccion de roles"
                            :maxSelectedLabels="3" class="w-full " />
                        <small class="text-red-500" v-for="error of profile$.dataForm.selectedRoles.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
                    </div>


                    
                    </div>
                  


                    <div class="w-full flex justify-center lg:justify-content-end mt-4">
                        <Button @click="handleSubmit" label="Actualizar" class="w-11/12 lg:w-1/4  bg-blue-500" icon="pi pi-user-edit"/>
                    </div>
                    
                </form>
            </div>
          </div>
  
</template>

<script>

import { defineAsyncComponent } from 'vue'
import { mapActions, mapState, mapGetters } from 'vuex'
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, maxLength, minValue, maxValue, email} from '@vuelidate/validators'

export default {

    components: {
        PasswordComponent : defineAsyncComponent(() => import('../components/password/PasswordComponent.vue')) 
    },
    setup() {
      return { profile$: useVuelidate() }
    },
  
    methods: {
            loadData() {
                this.loadImage();
                this.loadRoles();
           
           
            },

            ...mapActions('roles', ['loadRoles']),
            ...mapActions('profile', ['uploadUser', 'loadImage', 'editUser']),

            onUpload(event) {
                const uploadedFiles = event.target.files[0];

                console.log("foto ", event.target.files)
                // Handle the uploaded files here
        
                const formData = new FormData();
                formData.append('image', uploadedFiles);

                this.uploadUser(formData);
                
       
            },

            async handleSubmit() {

                const result = await this.profile$.$validate()

                    if (!result) {
                        // notify user form is invalid
                        return
                    }

                const data = {
                        id  : this.data.id, 
                        name: this.dataForm.name,
                        selectedRoles  : this.dataForm.selectedRoles,
                        email : this.dataForm.email,

                    };

                console.log("enviando formulario ", data)

                this.editUser(data);
                

                
            },

            loadForm(){


                console.log("data de perfil ", this.data)

                this.dataForm.name            = this.data?.name
                this.dataForm.email             = this.data?.email

                const rolesArray = this.data.roles;
                console.log("roles ", rolesArray  )
                const roles = rolesArray.replace(/[()]/g, "").split(", ").map(name => ({ name }));

                
                this.dataForm.selectedRoles     = roles
                //this.loadMunicipality(this.data.municipality.departament_id)
            },

       
    },
    computed: {
        ...mapGetters('profile', ['getImage','getProfile','getMessageError']),
        ...mapGetters('roles', ['getRoles']),
        ...mapState('profile', ['isLoading']),

        data(){
            return this.getProfile()
        },

        roles(){
            console.log("roles perfil", this.getRoles())
            return this.getRoles()
        },

        messageError() {
            return this.getMessageError
        },

        imageProfile(){
            console.log("imagen front ", this.getImage())
            return this.getImage()
        },
        
        
    
    },

    data(){

        return{
            image: '',
            value: null,
            type: 'user',
            dataForm:{
                name:'',
                email:'',
                selectedRoles:'',
            },
        }
    },
    validations(){

            if(this.type == 'user'){
                
                return{

                            dataForm:{
                                name                  : { required, minLength: minLength(5), maxLength: maxLength(25) },
                                email                 : { required, email },
                                selectedRoles         : { required },
                            }

                        }
            }
         
 
      
    },
    created(){
        this.loadData()
        
        setTimeout(() => {
            this.loadForm();
        }, 3000);

        
    }

}
</script>

<style>

.pass{
  width: 100%;
  background-color: aqua;
}
</style>
