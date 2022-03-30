
<template>
    <div class="row">
        <!--<div class="form-group">-->
            <!--<router-link :to="{name: 'createCompany'}" class="btn btn-success">Create new image</router-link>-->
        <!--</div>-->
                    <div  class="col-md-3 no-padding" v-for="image, index in images" style="padding:5px;">
                        <div class="view hm-zoom">
                        <a :href="imageURL + image.id"><img class="img-fluid" :src="imagePath + image.path" alt=""></a>
                        </div>
                        <router-link title="Edytuj zdjęcie" v-if="checkIfAuthor()"   style="position: absolute;top: -1px;right: 36px;padding: 6px 12px;font-size: 12px;" :to="{name: 'editImage', params: {id: image.id}}" class="btn btn-xs btn-success">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </router-link>
                        <a title="Usuń zdjęcie" v-if="checkIfAuthor()" href="#"
                           class="btn btn-xs btn-danger" style="position: absolute;top: -1px;right: -1px;padding: 6px 12px;font-size: 12px;"
                           v-on:click="deleteEntry(image.id, index)">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: function () {
            return {
                images: [],
                imagePath: '',
                imageURL: '',
                user_id: window.Laravel.user_id,
                author_id: window.Laravel.author_id
            }
        },
        mounted() {
            var app = this;
            let userid = app.user;
            console.log('actuall logged user id: ' + this.user_id);
            console.log('author id ' + this.author_id);
            // console.log(checkIfAuthor());
            app.imagePath = './storage/users/' + userid + '/images/thumb-';
            app.imageURL = './sorage/users/' + userid + '/images/';
            axios.get('api/v1/users/' + userid + '/images')
                .then(function (resp) {
                    app.images = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load images");
                });
            console.log(this.checkIfAuthor());
        },
        methods: {
            checkIfAuthor(){
                if(this.user_id == this.author_id){
                    return true;
                } else {
                    return false;
                }
            },
            deleteEntry(id, index) {
                if (confirm("Jesteś pewien że chcesz usunąc to zdjęcie?")) {
                    var app = this;
                    axios.delete('api/v1/images/' + id)
                        .then(function (resp) {
                            app.images.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete image");
                        });
                }
            }
        }
    }
</script>
