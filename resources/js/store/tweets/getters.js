export default {
    tweets: state => state._tweets.sort((a, b) => b.created_at - a.created_at),
    tweet: state => id => state._tweets.find(t => t.id === id)
}
