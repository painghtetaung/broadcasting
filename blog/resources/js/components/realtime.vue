<template>
    <div class="commentui">
         
        <ul class="list-group" v-for="comment in comments" :key="comment.id">
           
             
                <li class="list-group-item">
                    {{ comment.content }}
                    <a :href="'/comments/delete/'+comment.id" >
                        &times;
                    </a> 
                     <div class="small mt-2">
                        By <b>{{ comment.user.name }}</b>
                        {{ comment.created_at }}

                    </div>
                </li>
           
        </ul> 

       
        <!-- <input type="hidden" name="articleid" :value="articleid"> -->
        <div v-if="user">
            <textarea name="content" class="form-control mb-2" placeholder="New Comment" v-model="commentBox"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-secondary" @click.prevent="postComment">
        </div>
        <div v-else>
            <h4>You must be logged in to submit a comment!</h4> <a href="/login">Login Now &gt;&gt;</a>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['articleid','user'],
       
        data() {
            return {
                comments: [],
                commentBox: '',

            };
        },

        created() {
            axios.get('/articles/detail/'+this.articleid+'/comments')
                .then((response) => { 
                this.comments = response.data
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        mounted() {
             this.listen();
        },

        methods: {

            postComment() {
            axios.post('/articles/detail/'+this.articleid+'/comment', {
                content: this.commentBox
            })
                .then((response) => {
                this.comments.unshift(response.data);
                this.commentBox = '';
                })
                .catch((error) => {
                    console.log(error);
                });
             },

            listen() {
                Echo.channel('article.'+this.articleid)
                    .listen('NewComment', (comment) => {
                        this.comments.unshift(comment);
                    })
            }

             
             
        }
        


     
    }    

</script>
