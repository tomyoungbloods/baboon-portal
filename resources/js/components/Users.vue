<template>
    <div class="container">

        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Table</h3>

                <div class="card-tools">
                  <button class="btn btn-succes baboon-btn" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i> </button>
                </div>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Type</th>
                      <th>Register At</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                    <tr v-for="user in users" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.type | upText}}</td>
                      <td>{{user.created_at | myDate}}</td>
                      <td>
                          <a href=# @click="editModal(user)">
                              <i class="fa fa-edit baboon"></i>
                          </a>
                          /
                          <a href="#" @click="deleteUser(user.id)">
                              <i class="fa fa-trash"></i>
                          </a>

                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div v-if="!$gate.isAdminOrAuthor()">

            <not-found></not-found>
        </div>
        <div class="modal" id="addNew" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 v-show="editmode" class="modal-title">Bewerk gebruiker</h5>
                    <h5 v-show="!editmode" class="modal-title">Voeg gebruiker toe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name" placeholder="Naam"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email" placeholder="E-mail adres"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Selecteer een gebruikerstype</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.bio" type="text" name="bio" id="bio" placeholder="Korte omschrijving"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                                </textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>

                            

                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password" placeholder="Wachtwoord"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-primary">Bewerk</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Maak gebruiker aan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            
            return {
                editmode: false,

                users : {},

                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }

        },
        methods: {
            updateUser(){
                this.$Progress.start()
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                    $('#addNew').modal('hide')
                    swal.fire(
                                'Updated!',
                                'De gebruiker aangepast',
                                'success'
                            )
                            this.$Progress.finish()
                            Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail()
                })
            },
            editModal(user) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);

            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show')

            },
            deleteUser(id) {
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                        //Send request to the server
                            this.form.delete('api/user/' + id).then(()=>{
                                swal.fire(
                                'Deleted!',
                                'De gebruiker is gewist',
                                'success'
                                    )
                                Fire.$emit('AfterCreate');  
                            })
                        }
                        }).catch(()=> {
                            swal.fire('Oei!', 'Er gaat iets niet helemaal lekker.', 'warning');
                        });

                    

            },
            loadUsers(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/user").then(({ data }) => (this.users = data.data));
                }
            },
            createUser(){
                this.$Progress.start()
                this.form.post('api/user')
                .then(() => {
                    Fire.$emit('AfterCreate');

                    $('#addNew').modal('hide')

                    toast.fire({
                        icon: 'success',
                        title: 'Gebruiker is aangemaakt!'
                    })

                    this.$Progress.finish()

                    })
                    .catch(() => {
                        this.$Progress.fail()
                    })
            }
        },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            });
            // setInterval(() => this.loadUsers(), 3000);
        }
    }
</script>
