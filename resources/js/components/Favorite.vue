<template>
    <div>
        <button :class="classes" type="submit" @click="toggle">
                <i class="fa fa-heart"></i>
                <span v-text="favoritesCount"></span>
        </button>
    </div>
    
</template>
<script>
export default {
    props: ['reply'],

    data() {
        return {
            favoritesCount: this.reply.favoritesCount,
            isFavorited: this.reply.isFavorited 
        }
    },

    computed: {
        classes() {
            return ['btn', this.isFavorited ? 'btn-primary' : 'btn-outline-secondary'];
        }
    },

    methods: {
        toggle() {
            if(this.isFavorited){
                axios.delete('/replies/' + this.reply.id + '/favorites');
                this.isFavorited = false;
                this.favoritesCount--;
            } else {
                axios.post('/replies/' + this.reply.id + '/favorites');
                this.isFavorited = true;
                this.favoritesCount++;
            }
        }
    },
}
</script>