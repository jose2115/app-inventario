import foto1 from '@/assets/imagenes/foto-1.png';
import foto2 from '@/assets/imagenes/foto-2.png'; 
import foto3 from '@/assets/imagenes/foto-3.png';
import foto4 from '@/assets/imagenes/foto-4.png';  

export const PhotoService = {
    getData() {
        return [
            
            {
                itemImageSrc: foto2,
                thumbnailImageSrc: 'https://primevue.org/images/galleria/galleria4s.jpg',
                alt: 'Description for Image 4',
                title: 'Title 4'
            }
        ];
    },

    getImages() {
        return Promise.resolve(this.getData());
    }
};