  
<template>
<div :id="'reply-'+id" class="card mb-2" >
    <div class="card-header" :class="isBest ? 'bg-info text-white' : 'bg-light'">
        <div class="level">
            <h6 class="flex">
                <a :href="'/profiles/'+reply.owner.name" v-text="reply.owner.name"></a> said
                <span v-text="ago"></span>
            </h6>

            <div v-if="signedIn">
                <favorite :reply="reply"></favorite>
            </div>

        </div>
    </div>
    <div class="card-body">
        <div v-if="editing">
            <form @submit.prevent="update">
                <div class="form-group">

                <wysiwyg v-model="body"></wysiwyg>
                    <!--<textarea class="form-control" v-model="body" required></textarea>-->
                </div>

                <button class="btn btn-sm btn-primary">Update</button>
                <button class="btn btn-sm btn-link" type="button" @click="editing = false">Cancel</button>
            </form>
        </div>
        <div v-else v-html="body">

        </div>
    </div>
    <div class="card-footer level" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">
        <div  v-if="authorize('owns', reply)">
            <button class="btn btn-sm btn-dark mr-2" @click="editing = true">Edit</button>
            <button class="btn btn-sm btn-danger" @click="destroy">Delete</button>
        </div>
        <button class="btn btn-sm btn-outline-danger ml-auto" 
        v-if="authorize('owns', reply.thread)" @click="markBestReply" v-show="!isBest" >Best Reply?</button>
    </div>
</div>
</template>

<script>
import Favorite from './Favorite';
import moment from 'moment';
export default {
    props: ['reply'],
    components: {
        Favorite
    },
    data() {
        return {
            editing: false,
            id: this.reply.id,
            body: this.reply.body,
            isBest: this.reply.isBest,
        };
    },

     computed: {
        ago() {
            return moment(this.reply.created_at).fromNow() + '...';
        },
        //prebaceno u app.js
        // signedIn() {
            // return window.App.signedIn;
         },
        
    created() {
        window.events.$on('best-reply-selected', id => {
            this.isBest = (id === this.id)
        });
    },
    methods: {
        update() {
            axios.patch('/replies/' + this.id, {
                body: this.body
            }).catch(error => {
                flash(error.response.data, 'danger');
            }).then(({
                data
            }) => {
                this.editing = false;
                flash('Updated');
            });
        },
        destroy() {
            axios.delete('/replies/' + this.id);
            this.$emit('deleted', this.id);
        },
        markBestReply(){
            axios.post(`/replies/${this.id}/best`);
            window.events.$emit('best-reply-selected', this.id);
        },
    }
}
</script>