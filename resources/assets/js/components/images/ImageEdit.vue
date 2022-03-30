<template>
    <div v-if="checkIfAuthor()" class="row">
                    <div class="col-md-4 no-padding" >
                        <form v-on:submit="saveForm()" class="no-padding" style="padding-left:5px;">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="control-label">Tytuł</label>
                                    <input placeholder="Tytuł zdjęcia" type="text" v-model="image.title" class="form-control mb-0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="control-label">Alternatywny tytuł</label>
                                    <input placeholder="Tytuł alternatywny" type="text" v-model="image.alt" class="form-control mb-0">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label class="control-label">Opis zdjęcia</label>
                                    <input type="text" placeholder="Krótki opis zdjęcia" style=""  v-model="image.description" class="form-control mb-0">
                                </div>
                            </div>
                            <!--<div class="row">-->
                                <!--<div class="col-12 form-group">-->
                                    <!--<label class="control-label">Dostępność:</label>-->
                                    <!--<input type="text" v-model="image.visible_level" class="form-control">-->
                                <!--</div>-->
                            <!--</div>-->

                            <div class="row">
                                <div class="col-12 form-group">
                                    <fieldset class="form-group mb-0">
                                        <h6>Ocenianie:</h6>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" v-model="image.rating"  value="1"> Tak
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" v-model="image.rating"   value="0"> Nie
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 form-group">
                                    <fieldset class="form-group mb-0">
                                        <h6>Komentarze:</h6>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" v-model="image.comments"  value="1"> Tak
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" v-model="image.comments"  value="0"> Nie
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 form-group">
                                    <fieldset class="form-group mb-0">
                                        <h6>Dostępność:</h6>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" v-model="image.visible_level"  value="0" checked>
                                                Wszyscy użytkownicy
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" v-model="image.visible_level"  value="1">
                                                Zarejestrowani użytkownicy
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12 col-sm-offset-1">
                                    <label>Jeśli chcesz aby tylko wybrani użytkownicy widzieli ten album, zaznacz ich na poniższej liście
                                        <br> <small>(jeśli zostawisz wszystkie pola puste, album będzie domyślnie widoczny dla wszystkich)</small> </label>


                                    <div class="col-md-8 no-padding" style="padding:2px;">

                                        <label v-for="user in users" class="image-checkbox">
                                            <span><small>{{user.name}}</small></span>
                                            <input  type="checkbox" v-model="image.access_users" :value="user.id" />
                                        </label>

                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 form-group">
                                    <fieldset class="form-group mb-0">
                                        <h6>Zasady rozpowrzechniania:</h6>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" v-model="image.permission" value="1" checked>
                                                Zgoda na rozpowszechnianie
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" v-model="image.permission" value="0">
                                                Brak zgody na rozpowszechnianie
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 form-group">
                                    <button class="btn btn-success">Zapisz ustawienia zdjęcia</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group mb-0">
                            <router-link to="/" class="pull-right"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Powrót</router-link>
                        </div>
                        <img class="mt-2 img-fluid" :src="imageFullPath + image.path" alt="">
                    </div>
                </div>
</template>
<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.users = window.Laravel.users;
            app.imageFullPath = './storage/users/' + this.author_id + '/images/';
            app.imageId = id;
            axios.get('api/v1/images/' + id)
                .then(function (resp) {
                    app.image = resp.data;
                })
                .catch(function () {
                    alert("Could not load your image")
                });

        },
        data: function () {
            return {
                users: {},
                imageId: null,
                image: {
                    title: '',
                    alt: '',
                    description: '',
                    path: '',
                    visible_level: '',
                    permission: '',
                    comment: '',
                    rating: '',
                    access_users: []
                },
                imageFullPath: '',
                user_id: window.Laravel.user_id,
                author_id: window.Laravel.author_id,
            }
        },
        // mounted() {
        //     this.users = window.Laravel.users;
        //     console.log(window.Laravel.users);
        // },
        methods: {
            checkIfAuthor(){
                if(this.user_id == this.author_id){
                    return true;
                } else {
                    return false;
                }
            },
            saveForm() {
                if (this.checkIfAuthor()) {
                    event.preventDefault();
                    var app = this;
                    var newImage = app.image;
                    console.log(newImage);
                    axios.patch('api/v1/images/' + app.imageId, newImage)
                        .then(function (resp) {
                            app.$router.replace('/');
                        })
                        .catch(function (resp) {
                            alert("Could not create your image");
                        });
                }
            }
        }
    }
</script>
