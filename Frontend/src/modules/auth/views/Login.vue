

<template>
            
<!-- Container -->
<div class="flex flex-wrap min-h-screen w-full content-center justify-center bg-gray-200 py-10">
  
  <!-- Login component -->
  <div class="lg:flex shadow-md">
    <!-- Login form -->
    <div class="flex py-12 content-center justify-center rounded-l-md bg-white" style="width: 24rem;">
      <div class="w-72">

        <div class="w-full h-auto flex justify-center ">
          <img class=" h-28 object-cover" src="../../../assets/inventario.png"  alt="">
        </div>
        <!-- Heading -->
        <h1 class="text-xl font-semibold">Bienvenido a sistema de invenatrio</h1>
        <small class="text-gray-400">Inicia sesion con tu cuenta</small>
        <!-- Form -->
        <form class="mt-4" @submit.prevent="handleSubmit"  >
          <div class="mb-3">
              <div class="flex flex-column gap-2">
                <label for="username">Correo</label>
                <InputText id="username" v-model="userForm.email" @blur="v$.userForm.email.$touch" :class="{'p-invalid': v$.userForm.email.$errors.length > 0}" aria-describedby="username-help"/>
                <small class="text-red-500" v-for="error of v$.userForm.email.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
                <small class="text-red-500"  v-if="messageError" id="username-help">{{messageError}}</small>
              </div>
          </div>

          <div class="mb-3">
              <div class="flex flex-column gap-2">
                <label for="username">Contraseña</label>
                <InputText type="password"  v-model="userForm.password" @blur="v$.userForm.password.$touch" :class="{'p-invalid': v$.userForm.password.$errors.length > 0}" aria-describedby="username-help"/>
                <small class="text-red-500" v-for="error of v$.userForm.password.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
              </div>
          </div>

  

          <div class="mb-3 flex flex-wrap content-center">
            <!-- <a href="#" class="text-xs font-semibold text-purple-700">Forgot password?</a> -->
          </div>

          <div class="mb-3">
            <Button type="submit" label="Iniciar sesion" class="bg-portal hover:bg-portalhover w-full"/>
          </div>
        </form>

        <!-- Footer -->
        <div class="text-center">
          
        </div>
      </div>
    </div>

    <!-- Login banner -->
    

  </div>


</div>

</template>

<script>
import { ref } from 'vue'
import { mapActions, mapState, mapGetters } from 'vuex'
import { useVuelidate } from '@vuelidate/core'
import { email, required, minLength, maxLength,} from '@vuelidate/validators'

import Swal from 'sweetalert2'

export default {
    setup() {
      return { v$: useVuelidate() }
    },
    methods: {
      ...mapActions('auth', ['login']),

      async handleSubmit() {

        const result = await this.v$.$validate()
          if (!result) {
            // notify user form is invalid
            return
          }

          this.login(this.userForm)
   
            },
    },
    computed: {
        ...mapGetters('auth', ['getMessageError']),

        messageError() {
            return this.getMessageError
        },
    },
    data (){
      return {
        userForm: {
          email: '',
          password:''
        }
      }
    },
    validations(){
      return{
        userForm:{
          email: { required, email },
          password: { required, minLength: minLength(6), maxLength: maxLength(12), }
        }
      }
    }
}
</script>

<style lang="scss" >


</style>
