<template>

<div @click="handleClick" v-if="!menu" class="w-20 h-20 fixed bottom-6 right-6 z-40 hover:shadow-lg cursor-pointer ">
    <img class="w-full lg:w-auto absolute bottom-0 left-0" src="../../../assets/zpp.png" alt="plchldr.co" />
</div>

<div v-if="menu" class="fixed z-40 bottom-0 right-0 w-11/12 lg:w-1/4 2xl:w-1/5 h-auto">
    <div class="w-full h-auto py-1 flex justify-between bg-portal">
        <div class="w-14 flex justify-center items-center">
            <img class="h-12 lg:w-auto " src="../../../assets/zpp.png" alt="plchldr.co" />
        </div>
        <div class="w-14  flex justify-center items-center">
            <span @click="menu=false" class="pi pi-times text-xl text-white cursor-pointer "></span>
        </div>
    </div>
    <div class="w-full h-96 bg-gray-50 overflow-y-auto pt-3 px-2">

        <div v-for="(item, index) in messages" :key="index" class="w-full flex h-auto relative pl-5 mb-2" :class="{'justify-end pr-5 relative  mb-2': item.send == true}">
            <img v-if="item.send == false" class="h-7 lg:w-auto rounded-full mr-2 absolute bottom-0 left-0" src="../../../assets/zpp.png" alt="plchldr.co" />
            <div class="w-4/5 h-auto  rounded-lg p-2" :class="{'bg-portal rounded-lg pl-4 p-2 text-white': item.send == true, 'bg-gray-200 ': item.send == false }">
                <div v-if="!Array.isArray(item.message)"  v-html="item.message">

                </div>
                <div v-if="Array.isArray(item.message)" >
                    <ul class="list-decimal font-semibold mt-2">
                        <div @click="onSend(item)" v-for="(item, index) in item.message" :key="index"  class="bg-gray-500 rounded-lg py-2 px-4 mb-2 cursor-pointer">
                            <li class="text-white"  > {{item.opcion}} </li>
                        </div>
                    </ul>
                </div>
            </div>
            <img v-if="item.send == true"  class="h-7 lg:w-auto rounded-full absolute bottom-0 right-0" src="../../../assets/user.png" alt="plchldr.co" />

        </div>
        

    </div>
    <div class="hidden w-full h-12 bg-gray-100">
        <form class="flex w-full"  @submit.prevent="onSend">
            <div class="flex w-full">
                <InputText class="w-full" v-model="option" type="text" placeholder="Tu opción aquí" />
                <div class="w-3 h-12 flex justify-center items-center bg-portal cursor-pointer" @click="onSend">
                <span class="pi pi-send text-2xl text-white"></span>
                </div>
            </div>
        </form>
    </div>
</div>


</template>

<script>


export default {


    methods: {

        handleClick() {
            this.menu = true; // Cambia el valor de menu a true
            this.welcome(); // Llama a la función welcome
        },
    
        onMenu(){
            this.menu = !this.menu;
        },

        onSend(value){

            this.messages.push(
                {
                    'message': value.opcion,
                    'send'   : true
                }
            )

            if(value.id == 'A'){

                this.menuPrincipal()

                return
            }

            this.addOptiones(value)

        },
        

        welcome(){

            //validar si ya hay una bienvenida

            const mensajeEncontrado = this.messages.find(objeto => objeto.message === this.json.bienvenida);

            if(!mensajeEncontrado){

                this.messages.push(
                    { 
                        'message': this.json.bienvenida,
                        'send'   : false
                    }
                )

                const mensaje = []

                this.json.opciones.forEach(element => {

                    mensaje.push(
                        {
                            'id'    : element.id,
                            'opcion': element.texto,
                            'respuesta': element.respuesta,
                            'opciones': element.subopciones
                        }

                    )
                });

            
                this.messages.push(
                    {
                        'message': mensaje,
                        'send'   : false
                    }
                )

                console.log("mensajes ", this.messages)

                //const mensajesUnidos = mensaje.join(''); // Unir los elementos sin comas

               /* this.messages.push(
                    { 
                        'message': '<ul class="list-decimal pl-4 font-semibold" >' + mensajesUnidos + '</ul>' ,
                        'send'   : false
                    }
                ) */
            }

            
        },

        addOptiones(value){

                const mensaje = []

                if(value.opciones == undefined){

                    this.messages.push(
                        { 
                            'message': value.respuesta,
                            'send'   : false
                        }
                    )

                    mensaje.push(
                        { 'id'    : 'A', 'opcion': 'Menu principal'},
                        { 'id'    : 'B', 'opcion': 'Atras'}
                    )

                this.messages.push(
                    {
                        'message': mensaje,
                        'send'   : false
                    }
                )
                }

                value.opciones.forEach(element => {

                    mensaje.push(
                        {
                            'id'    : element.id,
                            'opcion': element.texto,
                            'respuesta': element.respuesta,
                            'opciones': element.subopciones
                        }

                    )
                });

                mensaje.push(
                        { 'id'    : 'A', 'opcion': 'Menu principal'},
                        { 'id'    : 'B', 'opcion': 'Atras'}
                )

                this.messages.push(
                    {
                        'message': mensaje,
                        'send'   : false
                    }
                )
        },


        menuPrincipal(){

            const mensaje = []

                this.json.opciones.forEach(element => {

                    mensaje.push(
                        {
                            'id'    : element.id,
                            'opcion': element.texto,
                            'respuesta': element.respuesta,
                            'opciones': element.subopciones
                        }

                    )
                });

                mensaje.push(
                        { 'id'    : 'A', 'opcion': 'Menu principal'},
                        { 'id'    : 'B', 'opcion': 'Atras'}
                    )

                this.messages.push(
                    {
                        'message': mensaje,
                        'send'   : false
                    }
                )
        }


    },
    computed: {

    
    },

    data(){

        return{
            menu: false,
            option:'',
            messages: [],
            json : {
                "bienvenida": "¡Hola! Soy un asistente virtual. Por favor, selecciona una opción: ",
                "opciones": [
                    {
                    "id": 1,
                    "texto": "Opción 1",
                    "respuesta": "Has seleccionado la opción 1. Esto es lo que quiero decirte sobre ella...",
                    "subopciones": [
                        {
                        "id": 1.1,
                        "texto": "Subopción 1.1",
                        "respuesta": "Esta es una subopción de la Opción 1. Esto es lo que quiero decirte sobre ella..."
                        },
                        {
                        "id": 1.2,
                        "texto": "Subopción 1.2",
                        "respuesta": "Esta es otra subopción de la Opción 1. Esto es lo que quiero decirte sobre ella..."
                        }
                    ]
                    },
                    {
                    "id": 2,
                    "texto": "Opción 2",
                    "respuesta": "Has seleccionado la opción 2. Esto es lo que quiero decirte sobre ella..."
                    },
                    {
                    "id": 3,
                    "texto": "Opción 3",
                    "respuesta": "Has seleccionado la opción 3. Esto es lo que quiero decirte sobre ella...",
                    "subopciones": [
                        {
                        "id": 3.1,
                        "texto": "Subopción 3.1",
                        "respuesta": "Esta es una subopción de la Opción 3. Esto es lo que quiero decirte sobre ella..."
                        }
                    ]
                    }
                ],
                "errorOption": "Debes seleccionar una de las opciones"
                },

        }
    },
   
    created(){
   
    }
}

</script>