<template>
    <div class="container">

        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bedrijven overzicht</h3>

                <div class="card-tools">
                  <button class="btn btn-succes baboon-btn" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i> </button>
                </div>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Logo</th>
                      <th>Name</th>
                      <th>E-mail</th>
                      <th>Tel</th>
                      <th>Website</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="company in companies" :key="company.id">
                        <td class="profile-img">
                            <img v-bind:src="'/img/profile/' + company.photo" />
                        </td>
                        <td>{{company.name}}</td>
                        <td>{{company.email}}</td>
                        <td>{{company.tel}}</td>
                        <td>{{company.web}}</td>
                        <td>
                            <a href=# @click="editModal(company)">
                                <i class="fa fa-edit baboon"></i>
                            </a>
                            /
                            <a href="#" @click="deleteCompany(company.id)">
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
                    <form @submit.prevent="editmode ? updateCompany() : createCompany()">
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
                                <input v-model="form.tel" type="text" name="tel" placeholder="Telefoonnummer"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('tel') }">
                                <has-error :form="form" field="tel"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.web" type="text" name="tel" placeholder="Website"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('tel') }">
                                <has-error :form="form" field="web"></has-error>
                            </div>
                            <div class="form-group row">
                            <label for="inputExperience" class="col-sm-2 col-form-label">Profiel Foto</label>
                            <div class="col-sm-10">
                                <input type="file" @change="updateProfile" name="photo" class="form-input">
                            </div>
                        </div>

                            <div class="form-group">
                                <textarea v-model="form.bio" type="text" name="bio" id="bio" placeholder="Korte omschrijving"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }">
                                </textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>



                            <!-- <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password" placeholder="Wachtwoord"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div> -->

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
                companies : {},
                form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    tel: '',
                    web: '',
                    bio: '',
                    photo: ''
                })
            }

        },
        methods: {
            loadcompanies(){
                if(this.$gate.isAdminOrAuthor()){

                    axios.get("api/company").then(({ data }) => (this.companies = data.data));
                }
            },
            updateCompany(){
                this.$Progress.start()
                this.form.put('api/company/'+this.form.id)
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
            editModal(company) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(company);

            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show')

            },
            deleteCompany(id) {
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
                            this.form.delete('api/company/' + id).then(()=>{
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
            loadCompany(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/company").then(({ data }) => (this.companies = data.data));
                }
            },
            createCompany(){
                this.$Progress.start()
                this.form.post('api/company')
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
            },
            updateProfile(e){

                // Take file
                let file = e.target.files[0];
                let reader = new FileReader();

                if (file['size'] < 2111775){
                     reader.onloadend = (file) => {
                        console.log('RESULT', reader.result)
                        this.form.photo = reader.result;
                    }

                reader.readAsDataURL(file);
                }else{
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Je upload een te grote afbeelding',

                    })

                }
            }
        },
        created() {
           this.loadCompany();
           Fire.$on('AfterCreate',() => {
               this.loadCompany();
           });
        //    setInterval(() => this.loadUsers(), 3000);
    }
    }

</script>
