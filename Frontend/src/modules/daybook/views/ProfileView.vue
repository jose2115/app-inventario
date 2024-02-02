<template>
   <div class="bg-white w-full h-auto relative shadow-md p-4" >

        <div class="w-full flex items-center justify-left border-b border-b-gray-300 pb-4">
            <i class='bx bxs-user-detail text-xl mr-2 '></i>
            <span class="font-semibold text-gray-800">Mi Perfil</span>
        </div>
        <div class="w-full h-full mt-4  grid  lg:grid-cols-3 gap-5 pb-40 ">
          
          <div class="w-full h-fullpx-2 pr-12 ">

           
            <div class="w-full h-full pt-4">
              <PasswordComponent></PasswordComponent>

            </div>
          </div>

            <PerfilComponent></PerfilComponent>

              
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
        PasswordComponent : defineAsyncComponent(() => import('../components/password/PasswordComponent.vue')), 
         PerfilComponent : defineAsyncComponent(() => import('../components/PerfilComponent.vue')) 
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
