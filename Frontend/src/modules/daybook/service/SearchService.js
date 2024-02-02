import foto0 from '@/assets/imagenes/foto-0.jpg';
import foto1 from '@/assets/imagenes/foto-1.png';
import foto2 from '@/assets/imagenes/foto-2.png'; 
import noticia3 from '@/assets/imagenes/noticia3.png';
import noticia4 from '@/assets/imagenes/noticia4.jpg';
import noticia5 from '@/assets/imagenes/noticia5.jpg';
import video3 from '@/assets/videos/video-4.mp4';  

export const SearchService = {
    getSearchsData() {
        return [
            {
                id: '1000',
                code: 'f230fh0g3',
                name: 'Pagina: Estaciónate',
                description: 'Las Zonas de Parqueo Pago cuentan con señalización que incluye el ícono de parqueo e información sobre el horario y tarifa del servicio para esa área.',
                image: foto0,
                type:'Pagina',
                link:'/estacionate'
            },
            {
                id: '1000',
                code: 'f230fh0g3',
                name: 'Pagina: Conócenos',
                description: 'Las Zonas de Parqueo Pago son áreas de la ciudad en las que la Alcaldía Mayor de Bogotá permite el estacionamiento de vehículos en vía a cambio de un pago por el uso de estos espacios.',
                image: foto0,
                type:'Pagina',
                link:'/conocenos'
            },
            {
                id: '1000',
                code: 'f230fh0g3',
                name: 'Pagina: Atención al ciudadano',
                description: 'Lista de preguntas frecuentes que hacen los cuidadanos.',
                image: foto0,
                type:'Pagina',
                link:'/atencion-al-ciudadano'
            },
            {
                id: '1000',
                code: 'f230fh0g3',
                name: 'Pagina: Enterate',
                description: 'Ultimos eventos hechos por la terminal que te pueden interesar.',
                image: foto0,
                type:'Pagina',
                link:'/noticia/nvklal433'
            },
            {
                id: '1000',
                code: 'f230fh0g3',
                name: 'Nuevos cupos del proyecto Zonas de Parqueo Pago en Nogales, La Macarena y Dorado Plaza',
                description: 'Después de esperar por más de dos décadas, Bogotá vive una transformación urbana en marcha con la implementación de las Zonas de Parqueo Pago como una solución de movilidad',
                image: foto0,
                type:'Noticia',
                link:'/noticia/f230fh0g3'
            },
            {
                id: '1001',
                code: 'nvklal433',
                name: 'Zona de Parqueo Pago fortalece su operación para mejorar la experiencia de los usuarios',
                description: 'La Terminal de Transporte de Bogotá contará con una nueva plataforma tecnológica que permitirá acceder a espacios de estacionamiento de manera rápida y sencilla a través de WhatsApp, Telegram o el Portal Web.',
                image: foto2,
                type:'Noticia',
                link:'/noticia/nvklal433'
            },
            {
                id: '1000',
                code: 'f230fh0g5',
                name: 'Así han sido los dos años de Zona de Parqueo Pago',
                description: 'Después de esperar por más de dos décadas, Bogotá vive una transformación urbana en marcha con la implementación de las Zonas de Parqueo Pago como una solución de movilidad',
                image: noticia3,
                video: video3,
                type:'Noticia',
                link:'/noticia/f230fh0g5'
            },
            {
                id: '1001',
                code: 'nvklal455',
                name: 'En noviembre, nuevos cupos de Zona de Parqueo Pago',
                description: 'Bogotá, 1 de noviembre de 2023. (@ZonaParqueoPago) Las Zonas de Parqueo Pago continúan creciendo para brindar una mayor oferta de estacionamiento en vía autorizado en la ciudad; durante el mes de noviembre entrarán en operación 990 cupos.',
                image: noticia4,
                type:'Noticia',
                link:'/noticia/nvklal455'
            },
            {
                id:'1002',
                code: 'nvbgre456',
                name:'Las Zonas de Parqueo Pago han recuperado más de 45 km de espacio público en Bogotá',
                description: 'Se han habilitado 7 mil cupos de estacionamiento en vía con más de 2.4 millones de usos.',
                image: noticia5,
                type:'Noticia',
                link:'/noticia/nvbgre456'
            }
        ];
    },


};