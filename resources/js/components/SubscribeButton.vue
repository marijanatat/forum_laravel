<template>
    <div>
        <button :class="classes" @click="subscribe" v-text="btnText"></button>
    </div>
</template>

<script>
export default {
    props: ['active'],

    data() {
        return {
            isActive: this.active
        }
    },

    computed: {
        classes() {
            return ['btn', this.isActive ? 'btn-primary' : 'btn-outline-secondary']
        },
        btnText() {
            return this.isActive ? 'Unsubscribe' : 'Subscribe';
        }
    },

    methods: {
        subscribe() {
            let requestType = this.isActive ? 'delete' : 'post';
            
            axios[requestType](location.pathname + '/subscriptions');

            this.isActive = !this.isActive;

        }
    },
}
</script>