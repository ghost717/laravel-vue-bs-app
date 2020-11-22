<template>
    <div>
        <div class="content"><!-- Main content -->
            <div class="container-fluid">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12 col-md-2">
                                    <h3 class="card-title m-0">
                                        Items
                                    </h3>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <button class="m-2 btn btn-warning" @click="getItems1">Items avaible</button>
                                        <button class="m-2 btn btn-warning" @click="getItems2">Items >= 5</button>
                                        <button class="m-2 btn btn-warning" @click="getItems3">Items <= 0</button>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="card-tools">
                                        <export-excel
                                            class   = "btn btn-dark"
                                            :data   = "items"
                                            worksheet = "Items"
                                            name    = "items.xls">
                                            Download items <i class="fas fa-arrow-alt-circle-down"></i>
                                        </export-excel>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#addNew" @click="openModalWindow">Add new <i class="fas fa-plus-square"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table id="items" class="table table-hover">
                                <thead class="thead">
                                    <tr class="row">
                                        <th class="col-3 col-sm-1 border-0">ID</th>
                                        <th class="col-6 col-sm-5 border-0">Name</th>
                                        <th class="col-3 col-sm-4 border-0">Amount</th>
                                        <th class="col-sm-2 text-right d-none d-sm-block border-0">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in items" class="row">
                                        <td class="col-3 col-sm-1" scope="row">{{item.id}}</td>
                                        <td class="col-6 col-sm-5">{{item.name}}</td>
                                        <td class="col-3 col-sm-4">{{item.amount}}</td>
                                        <td class="col-12 col-sm-2 buttons d-flex justify-content-end align-items-center">
                                            <a href="#" class="m-1 d-block float-right" data-id="item.id" @click="editModalWindow(item)">
                                                <button type="button" class="btn btn-sm btn-primary d-flex">
                                                    Update <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <a href="#" class="m-1 d-block float-right" data-id="item.id" @click="deleteItem(item.id)">
                                                <button type="button" class="btn btn-sm btn-danger d-flex">
                                                    Delete <i class="fas fa-trash"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                        <div class="card-tools row">
                            <div class="col-12">
                                <div class="d-flex justify-content-start align-items-center">
                                    <button v-if="next" type="button" @click="navigate(next)" class="m-2 btn btn-primary">Next</button>
                                    <button v-if="prev" type="button" @click="navigate(prev)" class="m-2 btn btn-primary">Previous</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>

                <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 v-show="!editMode" class="modal-title" id="addNewLabel">Add New Item</h5>
                                <h5 v-show="editMode" class="modal-title" id="addNewLabel">Update Item</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form @submit.prevent="editMode ? updateItem() : createItem()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input v-model="form.name" type="text" name="name" ref="name" placeholder="Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <input v-model="form.amount" type="text" name="amount" ref="amount" placeholder="Amount" class="form-control" :class="{ 'is-invalid': form.errors.has('amount') }">
                                        <has-error :form="form" field="amount"></has-error>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                                    <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- .modal -->

            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getItems();
        },
        data() {
            return {
                editMode: false,
                items: [],
                next: null,
                prev: null,
                form: new Form({
                    id: '',
                    name : '',
                    amount: '',
                }),
            }
        },
        methods: {
            openModalWindow(){
                this.editMode = false
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModalWindow(item){
                this.editMode = true
                this.form.reset();
                $('#addNew').modal('show');
                this.form.id = item.id;
                this.form.name = item.name;
                this.form.amount = item.amount;
            },
            getItems(address) {
                this.$Progress.start();
                axios.get(address ? address : "/api/items").then(response => {
                    this.items = response.data.data;
                    this.prev = response.data.links.prev;
                    this.next = response.data.links.next;
                    this.$Progress.finish();
                });
            },
            updateItem(){
                this.$Progress.start();
                // axios.put('/api/items/' + this.form.id, this.form).then(response => {
                //     this.getItems();
                //     this.$Progress.finish();
                //     $('#addNew').modal('hide');
                // });
                this.form.put('/api/items/'+this.form.id).then(item => {
                    // this.successful = true;
                    // this.error = false;
                    this.getItems();
                    this.$Progress.finish();
                    $('#addNew').modal('hide');
                }).catch(()=>{
                    console.log("Error")
                });
            },
            createItem(){
                this.$Progress.start();
                this.form.post('/api/items').then(item => {
                    // this.successful = true;
                    // this.error = false;
                    this.getItems();
                    this.$Progress.finish();
                    $('#addNew').modal('hide');
                }).catch(()=>{
                    console.log("Error")
                });
            },
            deleteItem(id){
                axios.delete("/api/items/" + id).then(response => this.getItems())
            },
            navigate(address) {
                this.getItems(address)
            },
            getItems1(){
                this.$Progress.start();
                axios.get("/api/items1").then(response => {
                    this.items = response.data.data;
                    this.prev = response.data.links.prev;
                    this.next = response.data.links.next;
                    this.$Progress.finish();
                });
            },
            getItems2(){
                this.$Progress.start();
                axios.get("/api/items2").then(response => {
                    this.items = response.data.data;
                    this.prev = response.data.links.prev;
                    this.next = response.data.links.next;
                    this.$Progress.finish();
                });
            },
            getItems3(){
                this.$Progress.start();
                axios.get("/api/items3").then(response => {
                    this.items = response.data.data;
                    this.prev = response.data.links.prev;
                    this.next = response.data.links.next;
                    this.$Progress.finish();
                });
            }
        }
    }
</script>
