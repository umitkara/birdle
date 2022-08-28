import axios from "axios";
import {likes} from "../like";
import {retweets} from "../retweet";
import {get} from "lodash";

export default {
    async getTweets(url) {
        const response = await axios.get(url);
        this.pushTweets(response.data.data);
        likes().pushLikes(response.data.meta.likes);
        retweets().pushRetweets(response.data.meta.retweets);
        return response;
    },
    pushTweets(data) {
        this._tweets.push(
            ...data.filter((tweet) => {
                return !this._tweets.map(t => t.id).includes(tweet.id);
            })
        );
    },
    popTweet(id) {
        this._tweets = this._tweets.filter(tweet => tweet.id !== id);
    },
    setLikes(id, count) {
        this._tweets = this._tweets.map(tweet => {
            if (tweet.id === id) {
                tweet.like_count = count;
            }
            if (get(tweet.original_tweet, "id") === id) {
                tweet.original_tweet.like_count = count;
            }
            return tweet;
        })
    },
    setRetweets(id, count) {
        this._tweets = this._tweets.map(tweet => {
            if (tweet.id === id) {
                tweet.retweet_count = count;
            }
            if (get(tweet.original_tweet, "id") === id) {
                tweet.original_tweet.retweet_count = count;
            }
            return tweet;
        })
    },
    setReplies(id, count) {
        this._tweets = this._tweets.map(tweet => {
            if (tweet.id === id) {
                tweet.reply_count = count;
            }
            if (get(tweet.original_tweet, "id") === id) {
                tweet.original_tweet.reply_count = count;
            }
            return tweet;
        })
    },
    async deleteTweet(id) {
        this._tweets = this._tweets.filter(tweet => tweet.id !== id);
        await axios.delete(`/api/tweet/${id}`);
    }
}
