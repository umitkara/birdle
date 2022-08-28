import axios from "axios";

let cancelController = new AbortController();

export default {
    data() {
        return {
            form: {
                body: '',
                media: []
            },
            media: {
                images: [],
                video: null,
                progress: 0,
            },
            mediaTypes: {
                image: [],
                video: null,
            },
            mediaError: null,
        }
    },
    methods: {
        async submit() {
            await axios.post('/api/media', this.buildMediaForm(), {
                signal: cancelController.signal,
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: this.handleUploadProgress,
            }).then(async response => {
                this.form.media = response.data.data.map(t => t.id);

                // await axios.post('/api/tweet', this.form);
                await this.post();

                this.form.body = '';
                this.form.media = [];
                this.media.images = [];
                this.media.video = null;
                this.mediaError = null;
                this.media.progress = 0;
            }).catch(error => {
                if (error.message !== 'canceled') {
                    this.mediaError = error.message;
                } else {
                    cancelController = new AbortController();
                }
                this.media.progress = 0;
            });
        },
        buildMediaForm() {
            let form = new FormData();
            if(this.media.images.length)
            {
                this.media.images.forEach((image, index) => {
                    form.append(`media[${index}]`, image);
                });
            }
            if(this.media.video)
            {
                form.append('media[0]', this.media.video);
            }
            return form;
        },
        async getMediaTypes() {
            let response = await axios.get('/api/media/types');
            this.mediaTypes = response.data.data;
        },
        handleTweetMedia(files) {
            Array.from(files).slice(0,4).forEach((file) => {
                if (this.mediaTypes.image.includes(file.type)) {
                    this.media.images.push(file);
                }
                if (this.mediaTypes.video.includes(file.type)) {
                    this.media.video = file;
                }
            });
            if (this.media.video) {
                this.media.images = [];
            }
        },
        removeVideo() {
            cancelController.abort();
            this.media.video = null;
            this.mediaError = null;
            this.media.progress = 0;
        },
        removeImage(image) {
            cancelController.abort();
            this.media.images = this.media.images.filter(item => item !== image);
            this.mediaError = null;
            this.media.progress = 0;
        },
        handleUploadProgress(event) {
            this.media.progress = (event.loaded * 100 / event.total);
        }
    },
    mounted() {
        this.getMediaTypes();
    }
}
