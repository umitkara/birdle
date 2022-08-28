<script setup>
import { likes } from '../../../store/like';
const store = likes();
</script>

<template>
    <a href="#" class="flex items-center
                    text-base text-gray-600
                    hover:text-red-400
                    transition ease-in-out duration-100"
       :class="{'text-red-400': liked}" @click.prevent="likeOrUnlike()">
        <i id="like" ref="like" class="fa-regular fa-heart w-5 mr-1" :class="{'fa-regular': !liked, 'fa-solid': liked}"></i>
        <span>{{ tweet.like_count }}</span>
    </a>
</template>
<script>

export default {
    name: 'AppTweetLikeAction',
    props: {
        tweet: {
            required: true,
            avatar: String,
            like_count: Number,
            id: Number,
        }
    },
    computed: {
        liked() {
            return this.store.likes.includes(this.tweet.id);
        },
    },
    methods: {
        likeOrUnlike() {
            if (this.liked) {
                //console.log(this.tweet.id);
                this.store.unlike(this.tweet.id);
            } else {
                //console.log(this.tweet.id);
                this.store.like(this.tweet.id);
            }
        },
    },
}
</script>
