
<template>
    <div class="row">

        <div  class="col-md-12" v-for="comment, index in comments" v-bind:key="index" >
            <p style="margin-bottom:2px; font-size:13px; font-weight:bold;">{{comment.user_name}} <small>{{comment.created_at}}</small></p>
            <p style="font-size:12px; line-height: 17px;  margin-bottom: 9px;">{{comment.body}}</p>
        </div>

        <div class="col-md-12">
        <form v-if="checkIfIsLogged()" v-on:submit="saveForm()">
            <div class="row">
                <div class="col-12 form-group">
                    <input style="font-size:12px; padding-left:7px;" placeholder="Tutaj wpisz treść komentarza" type="text" v-model="comment.body" class="form-control">
                </div>
            </div>
            <input style="display: none;"  type="submit" class="submit_on_enter btn btn-primary pull-right">
        </form>
        </div>

    </div>
</template>

<script>
    export default {
        data: function () {
            return {

                comments: [],
                comment: {
                    user_id: window.Laravel.user_id,
                    image_id: window.Laravel.image_id,
                    type: 'image',
                    body: ''
                },
                user: {},
                imagePath: '',
                imageURL: '',
                user_id: window.Laravel.user_id,
                author_id: window.Laravel.author_id,
                image_id: window.Laravel.image_id,
                is_logged: window.Laravel.is_logged
            }
        },
        mounted() {
            var app = this;
            let userid = app.user;
            let comments = app.comments;
            let imageid = app.image_id;
            console.log('actuall logged user id: ' + this.user_id);
            console.log('author id ' + this.author_id);
            console.log('image id ' + this.image_id);
            // console.log(checkIfAuthor());
            axios.get('api/v1/images/' + imageid + '/comments')
                .then(function (resp) {
                    app.comments = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load comments");
                });
            // console.log(this.checkIfAuthor());
        },
        methods: {
            checkIfIsLogged(){
                console.log('check if loggin: ' + this.is_logged);
                if(this.is_logged){
                    return true;
                } else {
                    return false;
                }
            },
            fetchCommentsList() {
                var app = this;
                var imageid = app.image_id;
                axios.get('api/v1/images/' + imageid + '/comments').then((res) => {
                    app.comments = res.data;
                });
            },
            saveForm() {
                console.log(this.comment);
                // event.preventDefault();
                var app = this;
                var newComment = app.comment;
                console.log(app.comment);
                axios.post('api/v1/comment', newComment)
                    .then(function (resp) {

                        newComment.body = '';
                        app.fetchCommentsList();
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your company");
                    });
            }
        }
    }
</script>
