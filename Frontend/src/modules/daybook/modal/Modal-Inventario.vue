<template>
    <div class="card justify-content-center">
        <form   @submit.prevent="handleSubmit">
            <div class="mb-3">
              <div class="flex flex-column gap-2">
                    <label for="username" class="text-gray-800">Nombre</label>
                    <InputText class="w-full"  v-model="dataForm.name" @blur="v$.dataForm.name.$touch" :class="{'p-invalid': v$.dataForm.name.$errors.length > 0}"/>
                    <small class="text-red-500" v-for="error of v$.dataForm.name.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
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
import { required, minLength, maxLength, minValue, maxValue} from '@vuelidate/validators'
export default {
    setup() {
      return { v$: useVuelidate() }
    },
    props:{
        typeSubmit:String,
        data:Object
    },
    methods: {
            ...mapActions('inventario', ['createInventario']),
            async handleSubmit() {

                const result = await this.v$.$validate()

                    if (!result) {
                        // notify user form is invalid
                        return
                    }

                
                if(this.typeSubmit == "Crear"){
                    const data = {
                     
                        name: this.dataForm.name
                    };
                   this.createInventario(data);
                }else{
                    const data = {
                        id  : this.data.id, 
                        name: this.dataForm.name,
                    };
                    this.editZona(data);
                }
                

                
            },
    },
    computed: {
        /* ...mapState('typeDocument', ['isLoading']),
        ...mapGetters('typeDocument', ['getMessageError']),

        messageError() {
            return this.getMessageError
        }, */
    },

    data(){

        return{
            value: null,
            
            dataForm:{
                name    : '',
            }
        }
    },
    validations(){
      return{
        dataForm:{
          name      : { required, minLength: minLength(4), maxLength: maxLength(20), },
        }
      }
    },
    created(){
 
        if(this.typeSubmit == "Edit"){
            this.dataForm.name = this.data.name
        }else{
            this.dataForm.name = ''
        }
    }
}
</script>

<style>

</style>