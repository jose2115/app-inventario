<template>
    <div class="card justify-content-center">
        <form   @submit.prevent="handleSubmit">
            <div class="mb-3">
              <div class="flex flex-column gap-2">
                    <label for="username" class="text-gray-800">Unidad</label>
                    <InputText class="w-full"  v-model="dataForm.unidad" @blur="v$.dataForm.unidad.$touch" :class="{'p-invalid': v$.dataForm.unidad.$errors.length > 0}"/>
                    <small class="text-red-500" v-for="error of v$.dataForm.unidad.$errors" :key="error.$uid" id="username-help">{{ error.$message }}</small>
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
import { required, minLength, maxLength, minValue, maxValue, numeric} from '@vuelidate/validators'
export default {
    setup() {
      return { v$: useVuelidate() }
    },
    props:{
        typeSubmit:String,
        data:Object,
        position:Object,
    },
    methods: {
            ...mapActions('inventario', ['createZona', 'editZona', 'updateUnidad']),
            async handleSubmit() {

                const result = await this.v$.$validate()

                    if (!result) {
                        // notify user form is invalid
                        return
                    }

                
                if(this.typeSubmit == "Crear"){
                    const data = {
                        id  : this.position, 
                        unidad: this.dataForm.unidad,
                        data: this.data
                    };
                   this.updateUnidad(data);
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
                unidad    : '',
            }
        }
    },
    validations(){
      return{
        dataForm:{
          unidad      : { required, minLength: minLength(1), maxLength: maxLength(4), },
        }
      }
    },
    created(){
        if(this.typeSubmit == "Edit"){
            this.dataForm.unidad = this.data.unidad
        }else{
            this.dataForm.unidad = this.data.unidad
        }
    }
}
</script>

<style>

</style>