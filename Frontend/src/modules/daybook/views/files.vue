<template>

 
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />

<div class="w-full pt-4 ">

    <div class="w-full h-auto flex justify-center items-center mb-2">
        <p class="text-xl font-semibold">Archivos importados</p>
    </div>

    <div class="w-full flex justify-center items-center ">
        <div v-if="files.length == 0" class="w-full h-auto">
            <div class=" relative py-2 flex w-full justify-center">
                <Button type="submit" label="Subir Archivo" class="bg-blue-500 w-auto h-10" icon="pi pi-upload"/>
                        <input class="cursor-pointer absolute h-12 top-4 block opacity-0 " type="file" name="vacancyImageFiles" @change="onUpload">
                        
            </div>
          
        </div>
       
    </div>

    <div v-if="isLoading" class="card px-2 mt-2">
        <ProgressBar mode="indeterminate" style="height: 6px"></ProgressBar>
    </div>
        

        <div class="w-full px-2 py-2">
            <div v-if="files.length > 0" class="w-full h-auto pl-2 border-2 border-gray-600 border-dashed ">

            <div class="w-full flex justify-start px-2 h-auto gap-4">
                
                
                <div class="w-auto h-12 bg-white py-2 ">
                    <Button @click="files = []" type="submit" label="Quitar" class="bg-gray-300 border-gray-500 text-gray-500 h-10" icon="pi pi-times"/>
                </div>
            
            </div>

            <div class="w-full h-24 overflow-y-auto  px-2 mt-4 grid gap-4 mb-4 ">

                <div v-for="(item, index) in files" :key="index" class="w-full h-24 grid grid-cols-5 gap-4 px-2 hover:bg-gray-50">
                    <div class="h-24 col-span-4 flex items-center">
                        <div class="mr-2">
                            <i v-if="item.type == 'pdf'" class="text-red-500 pi pi-file-pdf text-4xl" ></i>
                            <i v-if="item.type == 'xlsx'" class="text-green-500 pi pi-file-excel text-4xl" ></i>
                            <i v-if="item.type == 'docx'" class="text-blue-500 pi pi-file-word text-4xl" ></i>
                            <i v-if="item.type == 'jpg'" class="text-blue-300 pi pi-image text-4xl" ></i>
                            <i v-if="item.type == 'png'" class="text-blue-300 pi pi-image text-4xl" ></i>
                            <i v-if="item.type == 'zip'" class="text-gray-400 pi pi-file text-4xl" ></i>
                        </div>
                        <div>
                            <p class="text-base font-semibold" > {{item.name}} </p>
                            <p class="text-xl font-medium"> {{item.size}} </p>
                        </div>
                        
                    </div>
                    <div class="h-16 flex justify-center items-center">
                        <Button @click="eliminarElementoDeArray(index)" class="relative" icon="pi pi-times" severity="danger" text rounded aria-label="Cancel" />
                    </div>
                </div>

            </div>

        </div>
        </div>

        <div class="w-full px-2">
            <div v-if="files.length > 0" class="w-full flex justify-start h-auto gap-4">
                <div class="w-auto h-auto bg-white py-2 ">
                    <Button @click="subirArchivos" type="submit" label="Subir" class="bg-blue-500 h-10  " icon="pi pi-upload"/>
                </div>
                <div>
                    <p class="mt-3 font-semibold"> {{ files.length }} Archivos </p>
                </div>
            </div>
        </div>

        

    

    <div class="w-full  px-3 pt-4 h-screen overflow-y-auto py-2 ">

        <div v-for="(item, index) in importados" :key="index" class="w-full h-auto bg-gray-200 flex  mb-3   ">
            <div class="w-full h-24 col-span-4 flex items-center">
                        <div class="mr-2">
                            <i v-if="item.type == 'pdf'" class="text-red-500 pi pi-file-pdf text-4xl" ></i>
                            <i v-if="item.type == 'xlsx'" class="text-green-500 pi pi-file-excel text-4xl" ></i>
                            <i v-if="item.type == 'docx'" class="text-blue-500 pi pi-file-word text-4xl" ></i>
                            <i v-if="item.type == 'jpg'" class="text-blue-300 pi pi-image text-4xl" ></i>
                            <i v-if="item.type == 'png'" class="text-blue-300 pi pi-image text-4xl" ></i>
                            <i v-if="item.type == 'zip'" class="text-gray-400 pi pi-file text-4xl" ></i>
                        </div>
                        <div>
                            <p class="text-base font-semibold" > {{item.name}} </p>
                            <p class="text-xl font-medium"> {{item.size}} Mb </p>
                            <p class="font-semibold"><span class="font-normal"> {{item.date}} </span></p>
                        </div>
                        
            </div>
        
            <div class="w-2 h-auto py-2   flex justify-center items-center">
                <div class=" flex justify-left items-center relative " >
                    <span @click="eliminar(item.id)" class="pi pi-trash text-xl text-gray-700"></span>    
                </div>
            </div>
        </div>
    </div>
    
</div>

<Toast position="bottom-right" class="absolute right-0" />
    <ConfirmDialog></ConfirmDialog>

</template>

<script>

import { mapActions, mapState, mapGetters } from 'vuex'
import * as XLSX from 'xlsx';

import { data, agregarNuevoObjeto, obtenerTodosLosObjetos  } from '../service/ProductService';

import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";


export default {

    setup(){

        const confirm = useConfirm();
        const toast = useToast();

        return { confirm, toast }
    },

    components: {
     
    },
    methods: {
      
        agregarNuevoObjeto,
     obtenerTodosLosObjetos,
      onUpload(event) {
                        
                        for (let index = 0; index < event.target.files.length; index++) {
                            const element = event.target.files[index];

                            if(element.size > 50000000 ){

                                toast.add({ severity: 'error', summary: 'Error', detail: 'Archivo muy pasado', life: 3000 });

                                return true

                            }

                            if(!this.validarTypeFile(element.name)){

                                toast.add({ severity: 'error', summary: 'Error', detail: 'Este tipo de archivo no esta permitido', life: 3000 });

                                return true

                            }

                            this.processExcel(event.target.files[index]);

                            this.files.push(
                                {
                                    name: element.name,
                                    type: this.obtenerExtension(element.name),
                                    size:  this.bytesToKB(element.size),
                                    file: element 
                                }
                            )
                            console.log("archivo ", element)
                        }

                        console.log("archivo ", event.target.files.length)
                        // Handle the uploaded files here
            
        },

        bytesToKB(bytes) {
            const kilobytes = Math.round(bytes / 1024); // Redondear a kilobytes

            if (kilobytes < 1024) {
                return kilobytes + " KB";
            } else {
                const megabytes = (bytes / (1024 * 1024)).toFixed(2); // Redondear a 2 decimales
                return megabytes + " MB";
            }

        },

        obtenerExtension(cadena) {
            const partes = cadena.split('.');
            if (partes.length > 1) {
                return partes[partes.length - 1];
            } else {
                return "";
            }
        },

        validarTypeFile(type){

            

           const ext =  this.obtenerExtension(type)
           console.log("extencion ",ext)

            const extencion = [ 'xlsx']

            if (extencion.includes(ext)) {
                return true;
            } else {
                return false;
            }

        },

        eliminarElementoDeArray(indice) {
            if (indice >= 0 && indice < this.files.length) {
                this.files.splice(indice, 1); // Elimina 1 elemento en la posición "indice"
                return true; // Elemento eliminado exitosamente
            } else {
                return false; // Índice fuera de rango, no se pudo eliminar ningún elemento
            }
        },

        subirArchivos(){

            for (let index = 0; index < this.files.length; index++) {
                const element = this.files[index];

                    const formData = new FormData();
                    formData.append('file', element.file);


                    this.uploadExcel({formData});
            }

            this.files = []

        },

        loadData() {
            this.loadImportados();
        },

        processExcel(file) {
            const reader = new FileReader();

            reader.onload = (e) => {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });
                const sheetName = workbook.SheetNames[0];
                const sheet = workbook.Sheets[sheetName];

                // Convertir los datos de la hoja de Excel a un array de objetos
                const jsonData = XLSX.utils.sheet_to_json(sheet);

                // Guardar los datos en una variable del componente
                this.excelData = jsonData;

                console.log("datos de excel", this.excelData )
            };

            reader.readAsArrayBuffer(file);
        },

        eliminar(id){
                this.$confirm.require({
                    message: 'Esta seguro de eliminar el item?',
                    header: 'Confirmation',
                    icon: 'pi pi-info-circle',
                    acceptClass: 'bg-blue-500',
                    accept: () => {

            
                        this.deleteExcel(id)

                    },
                    
                });
            },

        ...mapActions('importados', ['loadImportados', 'uploadExcel', 'deleteExcel']),

    },
    computed: {
        
        ...mapGetters('importados', ['getImportados']),
        ...mapState('importados', ['isLoading']),

        importados(){
          return this.getImportados()
        }
    },
    data() {

         return {
            datos: data,
            excelData:'',
            value: null,
            files: [],
            visible:false,
            images: null,
            
         }
        
    },
    created() {
        this.loadData();
    },


}

</script>