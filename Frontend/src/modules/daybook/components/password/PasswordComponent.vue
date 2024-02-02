<template>

   
  <div class="w-full flex items-center justify-left border-b border-b-gray-300 pb-4">
                    <i class='bx bxs-key text-xl mr-2 '></i>
                    <span class="font-semibold text-gray-800">Cambiar contraseña</span>
                </div>
              <form  >

                    <div class="grid gap-4 px-2 mt-4">

                      <div class="flex flex-column gap-2">
                            <label for="username" class="text-gray-800">Contraseña antigua</label>
                            <InputText class="w-full" type="password"  v-model="dataFormp.oldPassword" @blur="v$.dataFormp.oldPassword.$touch" :class="{'p-invalid': v$.dataFormp.oldPassword.$errors.length > 0}"/>
                            <small class="text-red-500" v-for="error of v$.dataFormp.oldPassword.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
                      </div>

                      <div class="flex flex-column gap-2">
                            <label for="username" class="text-gray-800">Nueva contraseña</label>
                            <InputText class="w-full" type="password"  v-model="dataFormp.newPassword" @blur="v$.dataFormp.newPassword.$touch" :class="{'p-invalid': v$.dataFormp.newPassword.$errors.length > 0}"/>
                            <small class="text-red-500" v-for="error of v$.dataFormp.newPassword.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
                      </div>


                
                    </div>
                  


                    <div class="w-full flex justify-content-end mt-4">
                        <Button @click="dataPassword" label="Guardar" class="bg-blue-500" icon="pi pi-plus"/>
                    </div>
                    
                </form>


</template>

<script>


import { mapActions, mapState, mapGetters } from 'vuex'
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, maxLength} from '@vuelidate/validators'

export default {

    setup() {
        return { v$: useVuelidate() }
    },
    components: {
     
    },
    methods: {
   
        
        ...mapActions('auth', ['changePassword']),

      async dataPassword() {

                
                const result = await this.v$.$validate()

                    if (!result) {
                        // notify user form is invalid
                        return
                    }

                    

                    const data = {
                        oldPassword  : this.dataFormp.oldPassword, 
                        newPassword  : this.dataFormp.newPassword,
                    };

                   this.changePassword(data);

                
            },
    },
    computed: {
        

    },
    data() {

        return {
            visible: false,
            type: 'password',
            id: null,
            dataFormp:{
                oldPassword:'',
                newPassword:'',
            },

        }

    },
    validations(){

      if(this.type == 'password'){

        return{

                dataFormp:{
                  oldPassword  : { required, minLength: minLength(8), maxLength: maxLength(20) },
                  newPassword  : { required, minLength: minLength(8), maxLength: maxLength(20) },
                }

            }
      }
         

        
      
    },
    created() {
     
       
    }
}
</script>

<style>

</style>

