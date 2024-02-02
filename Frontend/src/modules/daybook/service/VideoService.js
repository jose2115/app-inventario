import video from '@/assets/videos/video.mp4';
import video2 from '@/assets/videos/video-2.mp4';
import video3 from '@/assets/videos/video-3.mp4';
import video4 from '@/assets/videos/video-4.mp4';

export const VideoService = {
    getData() {
        return [
            {
                itemVideoSrc: video,
                alt: 'Description for Image 1',
                title: 'Title 1'
            },
            {
                itemVideoSrc: video2,
                alt: 'Description for Image 2',
                title: 'Title 2'
            },
            {
                itemVideoSrc: video3,
                alt: 'Description for Image 3',
                title: 'Title 3'
            },
            {
                itemVideoSrc: video4,
                alt: 'Description for Image 4',
                title: 'Title 4'
            }
        ];
    },

    getVideos() {
        return Promise.resolve(this.getData());
    }
};